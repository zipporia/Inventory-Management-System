<!-- Navbar-->
<?php include_once 'templates/header.php'?>

<div class="overlay"><div class="loader"></div></div>

<br>
    <div class="container">
        <div class="card mx-auto" style="width: 30rem;">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form id="registerForm" onsubmit="return false" autocomplete="off"> <!--Login Form-->
                    <div class="form-group">
                        <label for="username">Full Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email Address</label>
                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" aria-describedby="emailHelp" placeholder="Email">
                        <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"  placeholder="Password">
                        <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="rePassword">Re-enter Password</label>
                        <input type="password" class="form-control" id="rePassword"  name="rePassword" placeholder="Password">
                        <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="userType">User Type</label>
                        <select class="form-control" name="userType" id="userType">
                            <option value="0">~~SELECT~~</option>
                            <option value="Admin">Admin</option>
                            <option value="Other">Other</option>
                        </select>
                        <small id="t_error" class="form-text text-muted"></small>
                    </div>
                    <button type="submit" class="btn btn-primary" name="userRegisterBtn"><i class="fa fa-sign-in"></i> Register</button>
                    <span><a href="#">Login</a></span>
                </form>
            </div>
        </div>
    </div>
<?php include_once 'templates/footer.php'?>
