<?php

include_once('../database/constants.php');
include_once('user.php');
include_once('DBOperation.php');
include_once("manage.php");

// For Registration Processing
if(isset($_POST["username"]) AND isset($_POST["emailAddress"])){
    $user = new User();
    $result = $user->createUserAccount($_POST["username"], $_POST["emailAddress"], $_POST["password"], $_POST["userType"]);
    echo $result;
    exit();
}

// For Login Processing
if(isset($_POST['log_email']) AND isset($_POST['log_pass'])){
    $user = new User();
    $result = $user->userLogin($_POST['log_email'], $_POST['log_pass']);
    echo $result;
    exit();
}

// get Category
if(isset($_POST['getCategory'])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecord('categories');
    foreach($rows as $row){
        echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
    }
    exit();
}

// get Brand
if(isset($_POST['getBrand'])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecord('brands');
    foreach($rows as $row){
        echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
    }
    exit();
}


// Add Category
if(isset($_POST['category_name']) AND isset($_POST['parent_cat'])){
    $obj = new DBOperation();
    $result =$obj->addCategory($_POST['parent_cat'], $_POST['category_name']);
    echo $result;
    exit();
}

// Add Brand
if(isset($_POST['brand_name'])){
    $obj = new DBOperation();
    $result = $obj->addBrand($_POST['brand_name']);
    echo $result;
    exit();
}

// Add Product
if(isset($_POST['added_date']) AND isset($_POST['product_name'])){
    $obj = new DBOperation();
    $result = $obj->addProduct( $_POST['select_cat'], 
                                $_POST['select_brand'], 
                                $_POST['product_name'], 
                                $_POST['product_price'], 
                                $_POST['product_qty'], 
                                $_POST['added_date']
                            );
    echo $result;
    exit();
}

// Manage Category
if(isset($_POST["manageCategory"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("categories", $_POST["pageno"]);
    
    $rows = $result["rows"];
    
    $pagination = $result["pagination"];
    
    if(count($rows) > 0){
        $n =  (($_POST["pageno"] - 1) * 5) + 1;
        // echo("<script>console.log('PHP: " . $n . "');</script>");    
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $n++ ?></td>
                    <td><?php echo $row["Category"] ?></td>
                    <td><?php echo $row["Parent"] ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
                        <a href="#" eid="<?php echo $row['cid']; ?>" class="btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#update_form_category">Edit</a>
                    </td>
                </tr>
            <?php
        }
        ?>
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}

// Delete Category
if(isset($_POST["deleteCategory"])){
    $m = new Manage();
    $result = $m->deleteRecord("categories", "cid", $_POST["id"]);
    echo $result;
}

// Update Category
if(isset($_POST["updateCategory"])){
    $m = new Manage();
    $result = $m->getSingleRecord("categories","cid", $_POST['id']);
    echo json_encode($result);
    exit();
}

// update record
if(isset($_POST['update_category'])){
    $m = new Manage();
    $id = $_POST['cid'];
    $name = $_POST['update_category'];
    $parent = $_POST['parent_cat'];
    $result = $m->update_record("categories", ["cid"=>$id],["parent_cat"=>$parent, "category_name"=>$name,"status"=>1]);
    echo $result;
}

// Brand ==============================================
// Manage Brand
if(isset($_POST["manageBrand"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("brands", $_POST["pageno"]);
    
    $rows = $result["rows"];
    
    $pagination = $result["pagination"];
    
    if(count($rows) > 0){
        $n =  (($_POST["pageno"] - 1) * 5) + 1;
        // echo("<script>console.log('PHP: " . $n . "');</script>");    
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $n++ ?></td>
                    <td><?php echo $row["brand_name"] ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
                        <a href="#" eid="<?php echo $row['bid']; ?>" class="btn btn-info btn-sm edit_brand" data-toggle="modal" data-target="#form_brand">Edit</a>
                    </td>
                </tr>
            <?php
        }
        ?>
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}

// Delete Brand
if(isset($_POST["deleteBrand"])){
    $m = new Manage();
    $result = $m->deleteRecord("brands", "bid", $_POST["id"]);
    echo $result;
}

// Update Brand
if(isset($_POST["updateBrand"])){
    $m = new Manage();
    $result = $m->getSingleRecord("brands","bid", $_POST['id']);
    echo json_encode($result);
    exit();
}

// update record
if(isset($_POST['update_brand'])){
    $m = new Manage();
    $id = $_POST['bid'];
    $name = $_POST['update_brand'];
    $result = $m->update_record("brands", ["bid"=>$id],["brand_name"=>$name,"status"=>1]);
    echo $result;
}

//========== Product ===========================================

if(isset($_POST["manageProduct"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("products", $_POST["pageno"]);
    
    $rows = $result["rows"];
    
    $pagination = $result["pagination"];
    
    if(count($rows) > 0){
        $n =  (($_POST["pageno"] - 1) * 5) + 1;
        // echo("<script>console.log('PHP: " . $n . "');</script>");    
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $n++ ?></td>
                    <td><?php echo $row["product_name"] ?></td>
                    <td><?php echo $row["category_name"] ?></td>
                    <td><?php echo $row["brand_name"] ?></td>
                    <td><?php echo $row["product_price"] ?></td>
                    <td><?php echo $row["product_stock"] ?></td>
                    <td><?php echo $row["added_date"] ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                        <a href="#" eid="<?php echo $row['pid']; ?>" class="btn btn-info btn-sm edit_product" data-toggle="modal" data-target="#form_products">Edit</a>
                    </td>
                </tr>
            <?php
        }
        ?>
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
}

// Delete Brand
if(isset($_POST["deleteProduct"])){
    $m = new Manage();
    $result = $m->deleteRecord("products", "pid", $_POST["id"]);
    echo $result;
}

// Update Brand
if(isset($_POST["updateProduct"])){
    $m = new Manage();
    $result = $m->getSingleRecord("products","pid", $_POST['id']);
    echo json_encode($result);
    exit();
}

// update record
if(isset($_POST['update_product'])){
    $m = new Manage();
    $id = $_POST['pid'];
    $name = $_POST['update_product'];
    $cat = $_POST['select_cat'];
    $brand = $_POST['select_brand']; 
    $price = $_POST['product_price']; 
    $qty = $_POST['product_qty'];
    $date = $_POST['added_date'];
    $result = $m->update_record("products", ["pid"=>$id],["pcid"=>$cat,"pbid"=>$brand, "product_name"=>$name, "product_price"=>$price, "product_stock"=>$qty, "added_date"=>$date]);
    echo $result;
}

if(isset($_POST['getNewOrderItem'])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("products");
    ?>
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select name="pid[]" class="form-control form-control-sm pid" required>
                <option value="">Select Product</option>
                <?php
                    foreach($rows as $row){
                        ?><option value="<?php echo $row['pid']; ?>"> <?php echo $row["product_name"]; ?> </option> <?php
                    }
                ?>
            </select>
        </td>
        <td> <input name="tqty[]" type="text" class="form-control form-control-sm tqty" readonly> </td>
        <td> <input name="qty[]" type="text" class="form-control form-control-sm qty" required> </td>
        <td> <input name="price[]" type="text" class="form-control form-control-sm price" readonly> </td>
        <span> <input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"> </span>
        <td>Rs.<span class="amt">0</span></td>
    </tr>
    <?php
    exit();
}

// get price and qty of one item
if(isset($_POST['getPriceAndQty'])){
    $m = new Manage();
    $result = $m->getSingleRecord("products", "pid", $_POST['id']);
    echo json_encode($result);
    exit();
}

if(isset($_POST['order_date']) AND isset($_POST['cust_name'])){
    
    $orderdate = $_POST['order_date'];
    $cust_name = $_post['cust_name'];

    //Now getting array from order_form
    $ar_tqty = $_POST['tqty'];
    $ar_qty = $_POST['qty'];
    $ar_price = $_POST['price'];
    $ar_pro_name = $_POST['pro_name'];

    $sub_total = $_POST['sub_total'];
    $gst = $_POST['gst'];
    $discount = $_POST['discount'];
    $net_total = $_POST['net_total'];
    $paid = $_POST['paid'];
    $due = $_POST['due'];
    $payment_type = $_POST['payment_type'];

    
}