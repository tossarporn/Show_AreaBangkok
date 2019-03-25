<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details=[];

if(isset($_POST['ref_tech_store']) && isset($_POST['ref_id_tec']) && isset($_POST['ref_cus'])){
        $ref_tech_store = $_POST['ref_tech_store'];
        $ref_id_tec = $_POST['ref_id_tec'];
        $ref_cus = $_POST['ref_cus'];
}
    $select = "SELECT * FROM `picture_banking`  
    WHERE `ref_tech_store`='{$ref_tech_store}' AND `ref_id_tec`='{$ref_id_tec}' AND `ref_cus`='{$ref_cus}'";
    if($res = mysqli_query($connection,$select)){
        if(mysqli_num_rows($res) == 0){
            $detail['message'] = "ไม่มีผู้ใช้อยู่ไหนระบบ";
            $detail['status'] = false;
        }else{
            $select_delete = "DELETE FROM `picture_banking` 
            WHERE `ref_tech_store`='{$ref_tech_store}' AND `ref_id_tec`='{$ref_id_tec}' AND `ref_cus`='{$ref_cus}'";
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