<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

    if(isset($_POST['tec_id'])){
        $select = "SELECT * FROM `customerforrent` WHERE `ref_id_tec`='".$_POST['tec_id']."'";
        if($res = mysqli_query($connection,$select)){
            while($row = mysqli_fetch_assoc($res)){
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