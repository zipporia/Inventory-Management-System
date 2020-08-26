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
            <div class="col-md-10 mx-auto">
                <div class="card" style="box-shadow: 0 0 25px 0 lightgrey;">
                    <div class="card-header">
                        <h4>New Orders</h4>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group row">
                                <label class="col-sm-3" align="right">Order Date</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" align="right">Customer Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" placeholder="Enter Customer Name" required>
                                </div>
                            </div>
                            <div class="card" style="box-shadow: 0 0 15px 0 lightgrey;">
                                <div class="card-body">
                                    <h3>Make a order list</h3>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once 'templates/categoryModal.php'?>
<?php include_once 'templates/brandModal.php'?>
<?php include_once 'templates/productModal.php'?>
<?php include_once 'templates/footer.php'?>