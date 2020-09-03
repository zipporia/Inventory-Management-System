<?php

  include_once("../fpdf/fpdf.php");

  if($_GET['order_date']){
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 16);
    $pdf->Cell(190,20, "Inventory System", 1, 1, "C");
    

    $pdf->Output();
  }