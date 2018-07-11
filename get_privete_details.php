<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details = [];

if(isset($_POST['ref_regis_tec'])){
    $ref_regis_tec = $_POST['ref_regis_tec'];
}

$select = "SELECT technician_store.ref_type,technician_type.type_name
FROM `technician_store` 
INNER JOIN technician_type ON technician_store.ref_type = technician_type.id 
WHERE  ref_regis_tec = '{$ref_regis_tec}'";

    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){
            $details[]=$row;
        }
    }
    else{
        $details['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    }

echo json_encode($details);
?>  