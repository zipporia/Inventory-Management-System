<?php

class Manage
{
    private $conn;

    function __construct(){
        include_once("../database/db.php");
        $db = new Database();
        $this->conn = $db->connect();
    }

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

}
