<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,TRUE);
$details = [];

if(isset($_POST['ref_tec']) && isset($_POST['ref_regis'])){
    $ref_tec = $_POST['ref_tec'];
    $ref_regis = $_POST['ref_regis'];
    $check_tus = $_POST['check_tus'];
}
$select="SELECT * FROM `guest_register`";

if($res = mysqli_query($connection,$select)){

    $update_guest = "UPDATE `guest_register` SET `check_tus`='{$check_tus}',`ref_store`='{$ref_tec}' WHERE `id` = '{$ref_regis}'";
            $details['message'] = "อัพเดตสำเร็จ";
            $details['status'] = true;
            $query = mysqli_query($connection,$update_guest);
    }
   
   else{
    $details['status'] = false;
    $details['message'] = "ไม่สามารถติดต่อกลับข้อมูลได้";
   }
   echo json_encode($details);
   mysqli_close($connection);

?>