<?php
    include_once("./database/constants.php");
    if(isset($_SESSION['userid'])){
        header("location: ".DOMAIN."dashboard.php");
    }
?>

<!-- Navbar-->
<?php include_once 'templates/header.php'?>

<div class="overlay"><div class="loader"></div></div>

<br>
    <div class="container">
        <?php
            if(isset($_GET['msg']) AND !empty($_GET['msg'])){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_GET['msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
        ?>
        <div class="card mx-auto" style="width: 18rem;">
            <img class="card-img-top mx-auto" style="width:40%; margin-top:15px;" src="images/login_image.png" alt="Login Icon">
            <div class="card-body">
                <form id="form_login" onsubmit="return false"> <!--Login Form-->
                    <div class="form-group">
                        <label for="log_email">Email address</label>
                        <input type="email" class="form-control" id="log_email" name="log_email" placeholder="E-mail">
                        <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="log_pass">Password</label>
                        <input type="password" class="form-control" id="log_pass" name="log_pass" placeholder="Password">
                        <small id="p_error" class="form-text text-muted"></small>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>
                    <span><a href="register.php">Register</a></span>
                </form>
            </div>
            <div class="card-footer"><a href="#">Forget Password</a></div>
        </div>
    </div>

<?php include_once 'templates/footer.php'?>
