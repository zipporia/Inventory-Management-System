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
        alert(did);
        console.log(did);
    });

}); // document ready function