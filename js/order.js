$(document).ready(function(){
  var DOMAIN = "http://localhost/Inventory-Management-System/";

  $("#add").click(function(){
    addNewRow();
  })

  function addNewRow(){
    $.ajax({
      url: DOMAIN+"includes/process.php",
      method: "POST",
      data: {getNewOrderItem:1},
      success: function(data){
        alert(data);
      }
    });
  }

}); // document ready function