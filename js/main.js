$(document).ready(function(){
    var DOMAIN = "http://localhost/Inventory-Management-System/";
    $("#registerForm").on("submit", function(){
        var status = false;
        var name = $("#username");
        var email = $("#emailAddress");
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

        if(!e_patt.test(email.val())){
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
            status = false;
        }else{
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if(password.val() == "" || password.val().length < 7){
            password.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please Enter more than 7 character password</span>");
            status = false;
        }else{
            password.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
        }
        if(rePassword.val() == "" || rePassword.val().length < 7){
            rePassword.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please Enter more than 7 character password</span>");
            status = false;
        }else{
            rePassword.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
        }
        if(userType.val() == "0"){
            userType.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Please Enter more than 7 character password</span>");
            status = false;
        }else{
            userType.removeClass("border-danger");
            $("#t_error").html("");
            status = true;
        }
        if((password.val() == rePassword.val()) && status == true){
            $(".overlay").show();
            $.ajax({
                url : DOMAIN+"includes/process.php",
                method: "POST",
                data: $("#registerForm").serialize(),
                success: function(data){
                    if(data == "EMAIL_ALREADY_EXISTS"){
                        $(".overlay").hide();
                        alert("It seems like you email is already used");
                    }else if(data == "SOME_ERROR"){
                        $(".overlay").hide();
                        alert("Something Wrong");
                    }else{
                        $(".overlay").hide();
                        window.location.href = encodeURI(DOMAIN+"index.php?msg=You are registered Now you can login");
                    }
                }
            });
        }else{
            rePassword.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password is not matched</span>");
            status = false;
        }
    }); // Form Register

    // For login part
    $("#form_login").on("submit", function(){
        var email = $("#log_email");
        var pass = $("#log_pass");
        var status = false;

        if(email.val() == ""){
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
            status = false;
        }else{
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if(pass.val() == ""){
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please Enter Email Address</span>");
            status = false;
        }else{
            pass.removeClass("border-danger");
            $("#p_error").html("");
            status = true;
        }
        if(status && !email.val() == ""){
            $(".overlay").show();
            $.ajax({
                url : DOMAIN+"includes/process.php",
                method: "POST",
                data: $("#form_login").serialize(),
                success: function(data){
                    if(data == "NOT_REGISTERD"){
                        $(".overlay").hide();
                        email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>You are not registered</span>");
           
                    }else if(data == "PASSWORD_NOT_MATCHED"){
                        $(".overlay").hide();
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Password not matched</span>");
                        status = false;
                    }else{
                        $(".overlay").hide();
                        console.log(data);
                        window.location.href = DOMAIN+"dashboard.php";
                    }
                }
            });
        }
       
    }); // form login

    // Fetch category
    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN+"/includes/process.php",
            method : "POST",
            data: {getCategory: 1},
            success: function(data){
                var root = "<option value='0'>Root</optoin>";
                $("#paretn_cat").html(root+data);
            }
        });
    }

    $("#category_form").on("submit", function(){
        if($("#category_name").val() == ""){
            $("#category_name").addClass("border_danger");
            $("#cat-error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else{
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data: $("#category_form").serialize(),
                success: function(data){
                    alert(data)
                }
            });
        }
    });
});