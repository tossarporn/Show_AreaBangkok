<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['ref_tec'])){
    $ref_tec = $_POST['ref_tec'];
}

$select = "SELECT AVG(`rating`) AS star FROM complacent WHERE `ref_tec`='{$ref_tec}'" ;
    
    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){

         $detail[]= $row['star']*1;
        }

    }

    else{
        $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    
    }
    echo json_encode($detail);
?>