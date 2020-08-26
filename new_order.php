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
                                <label class="col-sm-3 col-form-label" align="right">Order Date</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" align="right">Customer Name</label>
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
                                <!--<tr>
                                    <td><b id="number">1</b></td>
                                    <td>
                                        <select name="pid[]" class="form-control form-control-sm" required>
                                            <option>Washing Machine</option>
                                        </select>
                                    </td>
                                    <td> <input name="tqty[]" type="text" class="form-control form-control-sm" readonly> </td>
                                    <td> <input name="qty[]" type="text" class="form-control form-control-sm" required> </td>
                                    <td> <input name="price[]" type="text" class="form-control form-control-sm" readonly> </td>
                                    <td>Rs.1540</td>
                                    </tr>-->
                                    </tbody>
                                    </table>
                                    <center style="padding:10px;">
                                        <button id="add" style="width:150px;" class="btn btn-success">Add</button>
                                        <button id="remove" style="width:150px;" class="btn btn-danger">Remove</button>
                                    </center>
                                </div>
                            </div>
                            <p><p>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_total" id="sub_total" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="gst" id="gst" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                                <div class="col-sm-6">
                                    <input type="text" name="discount" id="discount" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="net_total" id="net_total" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                <div class="col-sm-6">
                                    <input type="text" name="paid" id="paid" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                                <div class="col-sm-6">
                                    <input type="text" name="due" id="due" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                                <div class="col-sm-6">
                                    <select name="payment_type" id="payment_type" class="form-control form-control-sm" required>
                                        <option value="">Cash</option>
                                        <option value="">Card</option>
                                        <option value="">Draft</option>
                                        <option value="">Cheque</option>
                                    </select>
                                </div>
                            </div>

                            <center>
                                <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                                <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                            </center>

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