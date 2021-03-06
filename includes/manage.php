<?php

class Manage
{
    private $conn;

    function __construct(){
        include_once("../database/db.php");
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function manageRecordWithPagination($table, $pno){
        $a = $this->pagination($this->conn, $table, $pno, 5);
        // echo("<script>console.log('PHP: " . $a["limit"]  ."');</script>");
        if($table == "categories"){
            $sql = "SELECT p.cid, p.category_name as Category, c.category_name as Parent, p.cid, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ".$a['limit'];
        }
        else if($table == "products"){
            $sql = "SELECT p.pid, p.product_name, c.category_name, b.brand_name, p.product_price, p.product_stock, p.added_date, p.p_status 
            FROM products p, brands b, categories c 
            WHERE p.pid = b.bid AND p.pcid=c.cid ".$a["limit"];
        }
        else{
            $sql = "SELECT * FROM " .$table." ".$a["limit"];
        }
        
        $result = $this->conn->query($sql) or die($this->conn->error);
        
        $rows = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
        } 
        
        return ["rows"=>$rows, "pagination"=>$a["pagination"]];
    }

    private function pagination($conn, $table, $pno, $n){
        
        $query = $conn->query("SELECT COUNT(*) as row FROM " .$table);
        
        $row = mysqli_fetch_assoc($query);
        
        // $totalRecords = 100000;
        $pageno = $pno;
        $numberofRecordsPerPage = $n;
           
        $last = ceil($row["row"]/$numberofRecordsPerPage);
        //  echo("<script>console.log('PHP: " . $table  ." $pageno');</script>");
    
        $pagination = "<ul class='pagination'>";
    
        if($last != 1){
            if($pageno > 1){
                $previous = "";
                $previous = $pageno - 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='text-decoration:none;color:black;'> Previous </a></li>";
            }
            for($i = $pageno - 5; $i < $pageno; $i++){
                if($i > 0){
                    $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#' style='text-decoration:none;'> ".$i." </a></li>" ;
                }
                
            }
    
            $pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='text-decoration:none;color:black'> $pageno </a></li>";
    
            for($i=$pageno + 1; $i <= $last; $i++){
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#' style='text-decoration:none;'> ".$i." </a></li>";
                if($i > $pageno + 4){
                    break;
                }
            }
            if($last > $pageno){
                $next = $pageno + 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='text-decoration:none;color:black;'> Next </a></li></ul>";
            }
        }
    
        $limit = "LIMIT ".($pageno - 1) * $numberofRecordsPerPage.",".$numberofRecordsPerPage;
    
        return ["pagination"=>$pagination, "limit"=>$limit];
    }

    public function deleteRecord($table, $pk, $id){
        if($table == "categories"){
            $pre_stmt = $this->conn->prepare("SELECT '".$id."' FROM categories WHERE parent_cat = ?");
            $pre_stmt->bind_param("i",$id);
            $pre_stmt->execute();
            $result = $pre_stmt->get_result() or die($this->conn->error);

            if($result->num_rows > 0){
                return "DEPENDENT_CATEGORY";
            }else{
                $pre_stmt = $this->conn->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->conn->error);
                if($result){
                    return "CATEGORY_DELETED";
                }
            }
        }else{
            $pre_stmt = $this->conn->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
            $pre_stmt->bind_param("i", $id);
            $result = $pre_stmt->execute() or die($this->conn->error);
                if($result){
                    return "DELETED";
                }
        }
    }// function delete record

    public function getSingleRecord($table, $pk, $id){
        $pre_stmt = $this->conn->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ?");
        $pre_stmt->bind_param("i", $id);
        $pre_stmt->execute() or die($this->conn->error);
        $result = $pre_stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
        }
        return $row;
    } // function getSingleRecord


    public function update_record($table, $where, $fields){
        $sql = "";
        $condition = "";
        foreach($where as $key => $value){
            $condition .= $key . "='" .$value . "' AND ";
        }
        $condition = substr($condition, 0, -5);

        foreach($fields as $key => $value){
            $sql .= $key . "='" .$value."', ";
        }

        $sql = substr($sql, 0, -2);
        $sql= "UPDATE ".$table. " SET " .$sql. " WHERE " .$condition;
        if(mysqli_query($this->conn,$sql)){
            return "UPDATED";
        }
    }

    public function storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, $sub_total, $gst, $discount, $net_total, $paid, $due, $payment_type){
        $pre_stmt = $this->conn->prepare("INSERT INTO `invoice`(`customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) 
        VALUES (?,?,?,?,?,?,?,?,?)");
        $pre_stmt->bind_param("ssdddddds", $cust_name, $orderdate, $sub_total, $gst, $discount, $net_total, $paid, $due, $payment_type);
        $pre_stmt->execute() or die($this->conn->error);
        $invoice_no = $pre_stmt->insert_id;
        if($invoice_no != null){
            for($i = 0; $i < count($ar_price); $i++){
                //Here we are finding the remaining quantity after giving customer
                $rem_qty = $ar_tqty[$i] - $ar_qty[$i];
                
                if($rem_qty < 0){
                    return "ORDER_FAIL_TO_COMPLETE";
                }else{
                    //Update Product Stock
                    $this->conn->query("UPDATE products SET product_stock = '$rem_qty' WHERE product_name = '".$ar_pro_name[$i]."' ");
                }

                $insert_product = $this->conn->prepare("INSERT INTO `invoice_details`( `invoice_no`, `product_name`, `price`, `qty`) 
                VALUES (?,?,?,?)");
                $insert_product->bind_param("isdd", $invoice_no, $ar_pro_name[$i], $ar_price[$i], $ar_qty[$i]);
                $insert_product->execute() or die($this->conn->error);
            }

            return $invoice_no;
        }
    }
}// Class Manage

//  $obj = new Manage();
// echo "<pre>";
// print_r($obj->manageRecordWithPagination("categories", 1));
// echo $obj->deleteRecord("categories", "cid" ,3);
//  print_r($obj->getSingleRecord("categories", "cid", 1));
// echo $obj->update_record("categories", ["cid"=>1],["parent_cat"=>0, "category_name"=>"Electro","status"=>1]);