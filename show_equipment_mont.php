<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['ref_id_tec'])){
    $ref_id_tec = $_POST['ref_id_tec'];
    $date_service = $_POST['date_service'];
}

$select = "SELECT COUNT(MONTH(`date of service`) ) AS sum_month, MONTH(`date of service`) AS list_month ,YEAR(`date of service`) AS list_year 
FROM `customerforrent` 
WHERE `ref_id_tec`='{$ref_id_tec}' AND YEAR(`date of service`) ='{$date_service}' 
GROUP BY MONTH(`date of service`)" ;
    
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