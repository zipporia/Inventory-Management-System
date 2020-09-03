<?php

  include_once("../fpdf/fpdf.php");

  if($_GET['order_date']){
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 16);
    $pdf->Cell(190,20, "Inventory Management System", 0, 1, "C");
    $pdf->SetFont("Arial", null, 12);
    $pdf->Cell(40, 10, "Date", 0, 0);
    $pdf->Cell(40, 10, ": " .$_GET['order_date'], 0, 1);
    $pdf->Cell(40, 10, "Customer Name", 0, 0);
    $pdf->Cell(40, 10, ": ".$_GET['cust_name'], 0, 1);

    $pdf->Cell(50, 10,"", 0, 1);

    $pdf->Cell(10, 10, "#", 1, 0, "C");
    $pdf->Cell(70, 10, "Product Name", 1, 0, "C");
    $pdf->Cell(30, 10, "Quantity", 1, 0, "C");
    $pdf->Cell(40, 10, "Price", 1, 0, "C");
    $pdf->Cell(40, 10, "Total (Rs", 1, 1, "C");
   
    for($i=0; $i < count($_GET['pid']); $i++){
      $pdf->Cell(10, 10, ($i+1), 1, 0, "C");
      $pdf->Cell(70, 10, $_GET['pro_name'][$i], 1, 0, "C");
      $pdf->Cell(30, 10, $_GET['qty'][$i], 1, 0, "C");
      $pdf->Cell(40, 10, $_GET['price'][$i], 1, 0, "C");
      $pdf->Cell(40, 10, ($_GET['qty'][$i] * $_GET['price'][$i]) , 1, 0, "C");
    }

    $pdf->Cell(50, 10,"", 0, 1);

    $pdf->Cell(50, 10, "Sub Total", 0, 0);
    $pdf->Cell(50, 10, ": ".$_GET['sub_total'],0,1);
    $pdf->Cell(50, 10, "Gst Tax", 0, 0);
    $pdf->Cell(50, 10, ": ".$_GET['gst'], 0, 1);


    $pdf->Output();
  }