<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$detail = [];
$select = "SELECT technician_store.name_store, 
technician_store.`account bank`, 
technician_store.home_number,
 technician_store.street, 
 technician_store.district, 
 technician_store.image_name, 
 technician_store.time_start, 
 technician_store.time_end, 
 technician_store.tel_technician, 
 technician_store.cost_begin, 
 technician_store.lat, 
 technician_store.lng, 
 technician_type.type_name, 
 area_bangkok.area_name 
 FROM `technician_store` INNER JOIN technician_type ON technician_store.ref_type = technician_type.id 
 INNER JOIN area_bangkok ON technician_store.ref_area = area_bangkok.id WHERE area_bangkok.id";

    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){

                $detail[] = $row;
        }

    }

    else{
        $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    
    }
    echo json_encode($detail);
?>