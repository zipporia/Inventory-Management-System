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
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
    </div>
<?php include_once 'templates/footer.php'?>