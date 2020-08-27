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

  $("#invoice_item").delegate(".pid", "change", function(){
    var pid = $(this).val();
    var tr = $(this).parent().parent();
    // $(".overlay").show();
    $.ajax({
      url: DOMAIN+"includes/process.php",
      method: "POST",
      dataType: "json",
      data: {getPriceAndQty:1,id:pid},
      success: function(data){
        tr.find(".tqty").val(data['product_stock']);
        tr.find(".pro_name").val(data["product_name"]);
        tr.find(".qty").val(1);
        tr.find(".price").val(data['product_price']);
        tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val());
      }
    })
  })

}); // document ready function