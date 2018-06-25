<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['area_id'])&& isset($_POST['equip_id'])){
$new_where = 'WHERE area_bangkok.id='.$_POST['area_id'].' AND  technician_type.id='.$_POST['equip_id'].'' ;
}
else{
    $new_where='';
}


$select = "SELECT 
technician_store.id,
technician_store.name_store, 
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
technician_store.ref_type,
technician_store.ref_area,
technician_type.type_name, 
area_bangkok.area_name,
technician_store.ref_regis_tec

FROM `technician_store` INNER JOIN technician_type ON technician_store.ref_type = technician_type.id 
INNER JOIN area_bangkok ON technician_store.ref_area = area_bangkok.id  
{$new_where}";


    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){
                

                $row["star"] = get_star($row['id'],$connection);
                $detail[] = $row;
        }

    }

    else{
        $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    
    }
    echo json_encode($detail);

function get_star($tec_id,$connection){

    $select = "SELECT AVG(`rating`) AS star FROM complacent WHERE `ref_tec`='{$tec_id}'" ;
    $star = 0;
    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){         
            $star = round($row["star"]*1);
        }

    }
    
    return $star;
}
?>


