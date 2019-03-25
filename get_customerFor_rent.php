<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

if(isset($_POST['ref_regis'])){
    $select = "SELECT * FROM `customerforrent` 
    WHERE `ref_regis`='".$_POST['ref_regis']."'";
    if($res = mysqli_query($connection,$select)){
        while($row = mysqli_fetch_assoc($res)){
            // $row['service_count'] = get_all_equipment($row['date of service'],$connection);
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

?>