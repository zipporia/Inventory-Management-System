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

    //Update category
    $("body").delegate(".edit_cat", "click", function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "post",
            datatype: 'json',
            data: {updateCategory:1, id:eid},
            success: function(data){
                alert(data);
            }
        });
    });

}); // document ready function