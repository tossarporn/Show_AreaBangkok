<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['ref_regis'])){
    // $select = "SELECT * FROM `guest_register` INNER JOIN technician_store on guest_register.ref_store = technician_store.id INNER JOIN customerforrent ON guest_register.ref_store = customerforrent.ref_tec WHERE  guest_register.ref_store='".$_POST['ref_store']."' AND guest_register.id = '".$_POST['ref_regis']."'";
    $select = "SELECT * FROM `guest_register`  
    WHERE `id`='".$_POST['ref_regis']."'";
    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){
            $row['details_store'] = ref_store($row['ref_store'],$connection);
            $detail[] = $row;
        }
    }
    else{
      $detail['message']  = "ไม่สามารถติดต่อข้อมูลได้";
    }
}
else {
    $detail['message']  = "ไม่สามารถติดต่อข้อมูลได้";
}
echo json_encode($detail);

function ref_store ($ref_store,$connection){
    $select_ref = "SELECT technician_store.name_store,
    technician_store.home_number,
    technician_store.street,
    area_bangkok.area_name,
    technician_store.district,
    technician_store.tel_technician,
    technician_store.image_name,
    technician_store.name_account,
    technician_store.lastname_account,
    technician_store.account_bank
    FROM `technician_store` INNER JOIN area_bangkok ON technician_store.ref_area = area_bangkok.id WHERE technician_store.id = '{$ref_store}'";
    if($res = mysqli_query($connection,$select_ref)){
        while($row = mysqli_fetch_assoc($res)){         
             $row_s[] = $row;
        }

    }
    return $row_s;
}



?>