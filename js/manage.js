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

   
}); // document ready function