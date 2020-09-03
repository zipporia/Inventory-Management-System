<?php

  include_once("../fpdf/fpdf.php");

  if($_GET['order_date']){
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 16);
    $pdf->Cell(190,20, "Inventory Management System", 0, 1, "C");
    $pdf->SetFont("Arial", null, 12);
    $pdf->Cell(40, 10, "Order Date", 0, 0);
    $pdf->Cell(40, 10, ": 2020-09-03", 0, 1);
    $pdf->Cell(40, 10, "Customer Name", 0, 0);
    $pdf->Cell(40, 10, ": Mark Yamar", 0, 1);
    // $pdf->Cell(190, 10,"", 1, 1);  

    $pdf->Output();
  }