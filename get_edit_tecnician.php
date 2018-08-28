<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details=[];


$select_regis ="SELECT * FROM `technician_store`  
JOIN area_bangkok ON technician_store.ref_area = area_bangkok.id 
JOIN `register` ON  register.id = technician_store.ref_regis_tec 
JOIN technician_type ON technician_type.id = technician_store.ref_type";
        if($res = mysqli_query($connection,$select_regis)){
            while($row = mysqli_fetch_assoc($res)){
                $detail[] = $row;
            }
        }
        else{
            $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
        }
        echo json_encode($detail);
?>