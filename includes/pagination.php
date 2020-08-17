<?php

$conn = mysqli_connect("localhost", "root", "", "test");

function pagination($conn, $table, $pno, $n){
    $query = $conn->query("SELECT COUNT(*) as rows FROM ".$table);
    $row = mysqli_fetch_assoc($query);
    // $totalRecords = 100000;
    $pageno = $pno;
    $numberofRecordsPerPage = $n;

    $last = ceil($row["rows"]/$numberofRecordsPerPage);

    $pagination = "";

    if($last != 1){
        if($pageno > 1){
            $previous = "";
            $previous = $pageno - 1;
            $pagination .= "<a href='pagination.php?pageno=".$previous."' style='text-decoration:none;color:black;'> Previous </a>";
        }
        for($i = $pageno - 5; $i < $pageno; $i++){
            if($i > 0){
                $pagination .= "<a href='pagination.php?pageno=".$i."' style='text-decoration:none;'> ".$i." </a>" ;
            }
            
        }

        $pagination .= "<a href='pagination.php?pageno=".$pageno."' style='text-decoration:none;color:black'> $pageno </a>";

        for($i=$pageno + 1; $i <= $last; $i++){
            $pagination .= "<a href='pagination.php?pageno=".$i."' style='text-decoration:none;'> ".$i." </a>";
            if($i > $pageno + 4){
                break;
            }
        }
        if($last > $pageno){
            $next = $pageno + 1;
            $pagination .= "<a href='pagination.php?pageno=".$next."' style='text-decoration:none;color:black;'> Next </a>";
        }
    }

    $limit = "LIMIT ".($pageno - 1) * $numberofRecordsPerPage.";".$numberofRecordsPerPage;

    return ["pagination"=>$pagination, "limit"=>$limit];
}

if(isset($_GET['pageno'])){
    $pageno = $_GET['pageno'];

    $table = "paragraph";

    $array = pagination($conn, $table, $pageno, 10);

    $sql = "SELECT * FROM ". $table." ".$array["limit"];
    
}
