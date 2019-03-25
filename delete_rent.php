<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details=[];

if(isset($_POST['ref_regis_tec'])){
    $ref_regis_tec = $_POST['ref_regis_tec'];
}
    $select = "SELECT `ref_regis_tec` FROM `technician_store` WHERE `ref_regis_tec`= '{$ref_regis_tec}'";
    if($res = mysqli_query($connection,$select)){
        if(mysqli_num_rows($res) == 0){
            $detail['message'] = "ไม่มีผู้ใช้อยู่ไหนระบบ";
            $detail['status'] = false;
        }else{
            $select_delete = "DELETE FROM `technician_store` WHERE `ref_regis_tec`= '{$ref_regis_tec}'";
            $detail['status'] = true;
            $detail['message'] = 'ลบข้อมูลสำเร็จ';
            $query = mysqli_query($connection,$select_delete);
        }

    }

else{
    $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
}
echo json_encode($detail);

?>