<!-- Navbar-->
<?php include_once 'templates/header.php'?>

<br><br>
    <div class="container">
        <div class="card mx-auto" style="width: 18rem;">
            <img class="card-img-top mx-auto" style="width:40%; margin-top:15px;" src="images/login_image.png" alt="Login Icon">
            <div class="card-body">
                <form> <!--Login Form-->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #002db3;"><i class="fa fa-sign-in"></i> Login</button>
                    <span><a href="#">Register</a></span>
                </form>
            </div>
            <div class="card-footer"><a href="#">Forget Password</a></div>
        </div>
    </div>

<?php include_once 'templates/footer.php'?>
