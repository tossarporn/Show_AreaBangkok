<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['user'])){
    $guest_name = $_POST['guest_name'];
    $guest_lastname = $_POST['guest_lastname'];
    $guest_tel = $_POST['guest_tel'];
    $guest_num_house = $_POST['guest_num_house'];
    $guest_street = $_POST['guest_street'];
    $guest_distric = $_POST['guest_distric'];
    $guest_area = $_POST['guest_area'];

    $user = $_POST['user'];
    $password = $_POST['password'];
    $status = $_POST['status'];
}

$select = "SELECT * FROM `guest_register` WHERE `username`='{$user}' AND `password` ='{$password}'";
if($res = mysqli_query($connection,$select)){
    if (mysqli_num_rows($res)>0) {
        $detail['message'] = "มีผู้ใช้รหัสผ่านนี้แล้ว";
        $detail['status'] = false;
    }
    else{

        $insert_guest_details = "INSERT INTO 
         `guest_register` (`id`, `username`, `password`, `status`, `guest_name`, `guest_lastname`, `guest_tel`, `guest_num_house`, `guest_street`, `guest_distric`, `guest_area`)  
        VALUES (NULL,'{$guest_name}','{$guest_lastname}','{$status}','{$guest_name}','{$guest_lastname}','{$guest_tel}','{$guest_num_house}','{$guest_street}','{$guest_distric}','{$guest_area}')";
                $detail['message'] = "สมัคสมาชิกสำเร็จ";
                $detail['status'] = true;   
        $query = mysqli_query($connection,$insert_guest_details);
    }

}
else{
            $detail['message'] = "ไม่สามารถติดต่อข้อมูลได้";
}       

echo json_encode($detail);


?>