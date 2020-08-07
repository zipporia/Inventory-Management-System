$(document).ready(function(){
    $("#registerForm").on("submit", function(){
        var status = false;
        var name = $("#username");
        var emailAddress = $("#emailAddress");
        var password = $("#password");
        var rePassword = $("#rePassword");
        var userType = $("#userType");
        var n_patt = new RegExp(/^[A-Za-z]$/);
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
        if(name.val() == "" || name.val().length < 6){
            name.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 char</span>");
            status = false;
        }else{
            name.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
        }
    });
});