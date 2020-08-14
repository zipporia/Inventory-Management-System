<?php

$conn = mysqli_connect("localhost", "root", "", "test");

function pagination($conn, $table, $pno, $n){
    $totalRecords = 100000;
    $pageno = $pno;
    $numberofRecordsPerPage = $n;

    $last = ceil($totalRecords/$numberofRecordsPerPage);

    $pagination = "";

    if($last != 1){
        if($pageno > 1){
            $previous = "";
            $previous = $pageno - 1;
            $pagination .= "<a href='".$previous."' style='text-decoration:none;color:black;'> Previous </a>";
        }
        for($i = $pageno - 5; $i < $pageno; $i++){
            if($i > 0){
                $pagination .= "<a href='".$i."' style='text-decoration:none;'> ".$i." </a>" ;
            }
            
        }

        $pagination .= "<a href='".$pageno."' style='text-decoration:none;color:red'> $pageno </a>";

        for($i=$pageno + 1; $i <= $last; $i++){
            $pagination .= "<a href='".$i."'> ".$i." </a>";
            if($i > $pageno + 5){
                break;
            }
        }
        if($last > $pageno){
            $next = $pageno + 1;
            $pagination .= "<a href='".$next."' style='text-decoration:none;color:black;'> Next </a>";
        }
    }

    return $pagination;
}

echo pagination($conn, "xxx", 3, 10);