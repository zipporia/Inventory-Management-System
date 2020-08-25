<?php
    include_once("./database/constants.php");
    if(!isset($_SESSION['userid'])){
        header("Location: ".DOMAIN."");
    }
?>

<!-- Navbar-->
<?php include_once 'templates/header.php'?>
    <br>
    

<?php include_once 'templates/categoryModal.php'?>
<?php include_once 'templates/brandModal.php'?>
<?php include_once 'templates/productModal.php'?>
<?php include_once 'templates/footer.php'?>