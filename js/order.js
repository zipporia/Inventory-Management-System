$(document).ready(function(){
  var DOMAIN = "http://localhost/Inventory-Management-System/";

  addNewRow();
  
  $("#add").click(function(){
    addNewRow();
  });

  function addNewRow(){
    $.ajax({
      url: DOMAIN+"includes/process.php",
      method: "POST",
      data: {getNewOrderItem:1},
      success: function(data){
        $("#invoice_item").append(data)
      }
    });
  }

  $("#remove").click(function(){
    $("#invoice_item").children("tr:last").remove();
  })

}); // document ready function