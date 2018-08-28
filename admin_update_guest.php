<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['guest_id'])){
    $guest_id = $_POST['guest_id'];
    $guest_name = $_POST['guest_name'];
    $guest_lastname = $_POST['guest_lastname'];
    $guest_tel = $_POST['guest_tel'];
    $guest_num_house = $_POST['guest_num_house'];
    $guest_street = $_POST['guest_street'];
    $guest_distric = $_POST['guest_distric'];
    $guest_area = $_POST['guest_area'];
    $guest_username = $_POST['guest_username'];
    $guest_password = $_POST['guest_password'];
}

$select_guest = "SELECT * FROM `guest_register` WHERE `id`='{$guest_id}'";

if($res = mysqli_query($connection,$select_guest)){
    if(mysqli_num_rows($res) !=1){
        $detail['message'] = "ไม่มีผู้ใช้อยู่ไหนระบบ";
        $detail['status'] = false;
    }
    else{
        $update_guest = "UPDATE `guest_register` SET `username`='{$guest_username}',`password`='{$guest_password}',`guest_name`='{$guest_name}',
        `guest_lastname`='{$guest_lastname}',`guest_tel`='{$guest_tel}',`guest_num_house`='{$guest_num_house}',`guest_street`='{$guest_street}',
        `guest_distric`='{$guest_distric}',`guest_area`='{$guest_area}'  WHERE `id` ='{$guest_id}'";  
        $detail['message'] = "อัพเดตสำเร็จ";
        $detail['status'] = true;  
        $query = mysqli_query($connection,$update_guest);
    }
}
else{
    $detail['message'] = "ไม่สามารถติดต่อข้อมูลได้";
}
echo json_encode($detail);
mysqli_close($connection);



?>