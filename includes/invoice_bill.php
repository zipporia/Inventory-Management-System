<?php

  include_once("../fpdf/fpdf.php");

  if($_GET['order_date']){
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Output();
  }