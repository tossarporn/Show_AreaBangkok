<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

    if(isset($_POST['ref_id_tec'])){
        $ref_id_tec = $_POST['ref_id_tec'];
        $ref_area_name = $_POST['ref_area_name'];
        $ref_type_equipment =$_POST['ref_type_equipment'];
        $name_store = $_POST['name_store'];
        $tel = $_POST['tel'];
        $account = $_POST['account'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $num_house = $_POST['num_house'];
        $cost_begin = $_POST['cost_begin'];
        $distric = $_POST['distric'];
        $street = $_POST['street'];
    }

$select_update_tec = "SELECT * FROM `technician_store` 
JOIN area_bangkok ON technician_store.ref_area = area_bangkok.id 
JOIN `register` ON  register.id = technician_store.ref_regis_tec 
JOIN technician_type ON technician_type.id = technician_store.ref_type WHERE `ref_regis_tec`='{$ref_id_tec}'";

if($query_update = mysqli_query($connection,$select_update_tec)){
    if(mysqli_num_rows($query_update)!=1){

        $detail['message'] = "ไม่มีผู้ใช้อยู่ไหนระบบ";
        $detail['status'] = false;
    }
    else{
    $update_technician = "UPDATE `technician_store` SET `name_store`='{$name_store}',`ref_type`='{$ref_type_equipment}',`ref_area`='{$ref_area_name}',
    `account_bank`='{$account}',`home_number`='{$num_house}',`street`='{$street}',`district`='{$distric}',`time_start`='{$time_start}',
    `time_end`='{$time_end}',`tel_technician`='{$tel}',`cost_begin`='{$cost_begin}'WHERE `ref_regis_tec`='{$ref_id_tec}'";
     $detail['message'] = "อัพเดตสำเร็จ";
     $detail['status'] = true;
     $query = mysqli_query($connection,$update_technician);
    }
}
else{
    $detail['message'] = "ไม่สามารถติดต่อข้อมูลได้";
}



echo json_encode($detail);



?>