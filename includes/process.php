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
                        <a href="#" eid="<?php echo $row['cid']; ?>"  class="btn btn-info btn-sm edit_cat">Edit</a>
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

