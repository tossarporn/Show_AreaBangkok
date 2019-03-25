<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details=[];

$select = "SELECT * FROM `details_admin`";

    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){
            $detail['message'] = 'ติดต่อกับข้อมูลสำเร็จ';
            $detail['status'] = true;
            $detail[] = $row;
        }
    }else{
        $detail['status'] = false;
        $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    }

echo json_encode($detail);
?>