<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['ref_id'])){
    $ref_id = $_POST['ref_id'];
}

$select = "SELECT COUNT(*) AS count_star,rating FROM complacent WHERE `ref_id`='{$ref_id}' GROUP BY rating" ;
    
    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){

            $detail[]= $row;    
        }

    }

    else{
        $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    
    }
    echo json_encode($detail);
?>