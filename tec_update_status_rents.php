<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,TRUE);
$details = [];

if(isset($_POST['ref_tec']) && isset($_POST['ref_regis'])){
    $ref_tec = $_POST['ref_tec'];
    $ref_regis = $_POST['ref_regis'];
    $ref_id_tec = $_POST['ref_id_tec'];
    $check_tus = $_POST['check_tus'];
}
$select="SELECT * FROM `customerforrent` INNER JOIN register ON customerforrent.ref_regis = register.id";

if($res = mysqli_query($connection,$select)){

    $update_guest = "UPDATE `customerforrent` SET `check_tus`='{$check_tus}' WHERE `ref_regis` ='{$ref_regis}'";
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