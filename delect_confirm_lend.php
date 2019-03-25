<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details=[];


if(isset($_POST['ref_tec']) && isset($_POST['ref_regis']) && isset($_POST['ref_id_tec']) ){
    $ref_tec = $_POST['ref_tec'];
    $ref_regis = $_POST['ref_regis'];
    $ref_id_tec = $_POST['ref_id_tec'];
}
    $select = "SELECT * FROM `customerforrent` 
    WHERE `ref_tec`= '{$ref_tec}' AND `ref_regis`= '{$ref_regis}' AND `ref_id_tec`= '{$ref_id_tec}'";
    if($res = mysqli_query($connection,$select)){
        if(mysqli_num_rows($res) == 0){
            $detail['message'] = "ไม่มีผู้ใช้อยู่ไหนระบบ";
            $detail['status'] = false;
        }else{
            $select_delete = "DELETE FROM `customerforrent` 
            WHERE `ref_tec`= '{$ref_tec}' AND `ref_regis`= '{$ref_regis}' AND `ref_id_tec`= '{$ref_id_tec}'";
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