<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['id_admin'])){
    $id_admin = $_POST['id_admin']; 
    $username = $_POST['username'];
    $password =$_POST['password'];
    $tel = $_POST['tel'];
    $account = $_POST['account'];
    $num_houst = $_POST['num_houst'];
    $street = $_POST['street'];
    $distric = $_POST['distric'];
    $area = $_POST['area'];
}

$select ="SELECT * FROM `details_admin` WHERE `id` = '{$id_admin}'";

if($query_update = mysqli_query($connection,$select)){
    if(mysqli_num_rows($query_update)!=1){

        $detail['message'] = "ไม่มีผู้ใช้อยู่ไหนระบบ";
        $detail['status'] = false;
    }
    else{
    $update_admin = "UPDATE `details_admin` SET `user_admin`='{$username}',`password_admin`='{$password}',`number_house_admin`='{$num_houst}',
    `street_admin`='{$street}',`distric_admin`='{$distric}',`area_admin`='{$area}',
    `account_bank_admin`='{$account}',`tel_admin`='{$tel}' WHERE `id`='{$id_admin}'";
     $detail['message'] = "อัพเดตสำเร็จ";
     $detail['status'] = true;
     $query = mysqli_query($connection,$update_admin);
     echo $update_admin;


    }
}
else{
    $detail['message'] = "ไม่สามารถติดต่อข้อมูลได้";
}

echo json_encode($detail);
?>