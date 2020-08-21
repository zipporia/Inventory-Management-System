<?php
    include_once("./database/constants.php");
    if(!isset($_SESSION['userid'])){
        header("Location: ".DOMAIN."");
    }
?>

<!-- Navbar-->
<?php include_once 'templates/header.php'?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem; margin:auto;">
                    <img class="card-img-top mx-auto" style="width:30%;margin-top:20px;" src="images/user_image.png"  alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-vcard-o"></i> Profile Info</h5>
                        <p class="card-text"><i class="fa fa-user-o"></i> Mark Cornelio</p>
                        <p class="card-text"><i class="fa fa-user"></i> Admin</p>
                        <p class="card-text"><i class="fa fa-clock-o"></i> Last Login : xxxx</p>
                        <a href="#" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit Profile</a>
                    </div>
                </div> 
            </div>  
            <div class="col-md-8">
                <div class="jumbotron" style="width:100%; height:100%; padding:15px;">
                    <h1>Welcome Admin</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe  style="margin-left: 40px;" src="http://free.timeanddate.com/clock/i7eink8q/n145/szw210/szh210/hoc000/hbw0/hfc09f/cf100/hnc07c/hwc000/facfff/fnu2/fdi76/mqcfff/mqs4/mql18/mqw4/mqd60/mhcfff/mhs4/mhl5/mhw4/mhd62/mmv0/hhcfff/hhs1/hhb10/hmcfff/hms1/hmb10/hscfff/hsw3" frameborder="0" width="210" height="210"></iframe>
                        </div>
                        <div class="col-sm-6">
                            <div class="card"   style="margin:auto;" >
                                <div class="card-body">
                                    <h4 class="card-title">New Orders</h4>
                                    <p class="card-text">Here you can make invoices and create new orders</p>
                                    <a href="#" class="btn btn-primary">New Orders</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <p></p>
    <p></p>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="margin:auto;width: 18rem;" >
                    <div class="card-body">
                        <h4 class="card-title">Categories</h4>
                        <p class="card-text">Here you can manage your categories</p>
                        <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#categoryModal">Add</a>
                        <a href="manage_categories.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Brands</h4>
                        <p class="card-text">Here you can manage your categories and you can add new parent and sub categories</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brandModal">Add</a>
                        <a href="manage_brand.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" >
                    <div class="card-body">
                        <h4 class="card-title">Product</h4>
                        <p class="card-text">Here you can manage your categories and you can add new parent and sub categories</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#productModal">Add</a>
                        <a href="#" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once 'templates/categoryModal.php'?>
<?php include_once 'templates/brandModal.php'?>
<?php include_once 'templates/productModal.php'?>
<?php include_once 'templates/footer.php'?>