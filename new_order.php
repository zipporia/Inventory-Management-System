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
                                    <table align="center" style="width:800px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="text-align:center;">Item Name</th>
                                                <th style="text-align:center;">Total Quantity</th>
                                                <th style="text-align:center;">Quantity</th>
                                                <th style="text-align:center;">Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                    <tbody id="invoice_item">
                                    <tr>
                                    <td><b id="number">1</b></td>
                                    <td>
                                        <select name="pid[]" class="form-control form-control-sm">
                                            <option>Washing Machine</option>
                                        </select>
                                    </td>
                                    <td> <input name="tqty[]" type="text" class="form-control form-control-sm"> </td>
                                    <td> <input name="qty[]" type="text" class="form-control form-control-sm"> </td>
                                    <td> <input name="price[]" type="text" class="form-control form-control-sm" readonly> </td>
                                    <td>Rs.1540</td>
                                    </tr>
                                    </tbody>
                                    </table>
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