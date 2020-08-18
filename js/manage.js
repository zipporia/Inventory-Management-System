$(document).ready(function(){
    var DOMAIN = "http://localhost/Inventory-Management-System/";

    manageCategory();
    function manageCategory(){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method: "POST",
            data: {manageCategory: 1},
            success: function(data){
                $("#get_category").html(data);
               
            } // success
        });
    }


}); // document ready function