$(document).ready(function(){
    var DOMAIN = "http://localhost/Inventory-Management-System/";

    manageCategory(1);
    function manageCategory(pn){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data: {manageCategory: 1, pageno: pn},
            success: function(data){
                $("#get_category").html(data);
               
            } // success
        });
    }

    $("body").delegate(".page-link","click", function(){
        var pn = $(this).attr("pn");
        manageCategory(pn);
    });

    $("body").delegate(".del_cat","click",function(){
        var did = $(this).attr("did");
        if(confirm("Are you sure? You want to delete!")){
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data: {deleteCategory: 1, id:did},
                success: function(data){
                    if(data == "DEPENDENT_CATEGORY"){
                        alert("Cannot be deleted");
                    }else if(data == "CATEGORY_DELETED"){
                        alert("deleted data");
                        manageCategory(1);
                    }else if(data == "DELETED"){
                        alert("deleted data also");
                    }else{
                        alert(data);
                    }
                    
                   
                } // success
            });
        }else{
            alert("No");
        }
    });

    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method : "POST",
            data: {getCategory: 1},
            success: function(data){
                var root = "<option value='0'> SELECT </option>";
                $("#parent_cat").html(root+data);
            }
        });
    } // fetch category

    //Update category
    $("body").delegate(".edit_cat", "click", function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN+"includes/process.php",
            method: "POST",
            datatype: "JSON",
            data: {updateCategory:1,id:eid},
            success: function(data){
                data = JSON.parse(data)
                $("#cid").val(data["cid"]);
                $("#update_category").val(data["category_name"]);
                $("#parent_cat").val(data["parent_cat"]);
            }
        });
    });

    $("#update_category_form").on("submit", function(){
        if($("#update_category").val() == ""){
            $("#update_category").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else{
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data: $("#update_category_form").serialize(),
                success: function(data){
                    window.location.href= "";
                }
            });
        }
    });

    /// Brand ===================================
    manageBrand(1);
    function manageBrand(pn){
        $.ajax({
            url: DOMAIN+"includes/process.php",
            method: "POST",
            data: {manageBrand: 1, pageno: pn},
            success: function(data){
                $("#get_brand").html(data);
               
            } // success
        });
    }

    $("body").delegate(".page-link","click", function(){
        var pn = $(this).attr("pn");
        manageBrand(pn);
    });

    // Delete Brand
    $("body").delegate(".del_brand","click",function(){
        var did = $(this).attr("did");
        if(confirm("Are you sure? You want to delete!")){
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data: {deleteBrand: 1, id:did},
                success: function(data){
                    if(data == "DELETED"){
                        alert("Brand deleted");
                        manageBrand(1);
                    }else{
                        alert(data);
                    }
                } // success
            });
        }
    });

     //Update Brand
     $("body").delegate(".edit_brand", "click", function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN+"includes/process.php",
            method: "POST",
            datatype: "JSON",
            data: {updateBrand:1,id:eid},
            success: function(data){
                data = JSON.parse(data)
                $("#bid").val(data["bid"]);
                $("#update_brand").val(data["brand_name"]);
            }
        });
    });

    $("#update_brand_form").on("submit", function(){
        if($("#update_brand").val() == ""){
            $("#update_brand").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        }else{
            $.ajax({
                url: DOMAIN+"includes/process.php",
                method: "POST",
                data: $("#update_brand_form").serialize(),
                success: function(data){
                    alert("data = " + data);
                    console.log(data)
                    window.location.href= "";
                }
            });
        }
    });

    // ============ Product =====================================

    manageProduct(1);
    function manageProduct(pn){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data: {manageProduct: 1, pageno: pn},
            success: function(data){
                $("#get_product").html(data);
               
            } // success
        });
    }

    $("body").delegate(".page-link","click", function(){
        var pn = $(this).attr("pn");
        manageProduct(pn);
    });

    // Delete Brand
    $("body").delegate(".del_product","click",function(){
        var did = $(this).attr("did");
        if(confirm("Are you sure? You want to delete!")){
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data: {deleteProduct: 1, id:did},
                success: function(data){
                    if(data == "DELETED"){
                        alert("Product deleted");
                        manageProduct(1);
                    }else{
                        alert(data);
                    }
                } // success
            });
        }
    });

}); // document ready function