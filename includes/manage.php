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
            $sql = "SELECT p.category_name as Category, c.category_name as Parent, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ".$a['limit'];
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
                $pre_stmt = $this->conn->prepare("DELETE FROM '".$table."' WHERE '".$pk."' = ?");
                $pre_stmt->bind_param("i", $id);
                $result = $pre_stmt->execute() or die($this->conn->error);
                if($result){
                    "CATEGORY_DELETED";
                }
            }
        }else{
            $pre_stmt = $this->conn->prepare("DELETE FROM '".$table."' WHERE '".$pk."' = ?");
            $pre_stmt->bind_param("i", $id);
            $result = $pre_stmt->execute() or die($this->conn->error);
                if($result){
                    "DELETED";
                }
        }
    }
}

// $obj = new Manage();
// echo "<pre>";
// print_r($obj->manageRecordWithPagination("categories", 1));
// echo $obj->deleteRecord("brands", 1);