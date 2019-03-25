<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

    if(isset($_POST['ref_tech_store']) && isset($_POST['ref_id_tec']) && isset($_POST['ref_cus'])){
        $ref_tech_store = $_POST['ref_tech_store'];
        $ref_id_tec = $_POST['ref_id_tec'];
        $ref_cus = $_POST['ref_cus'];

        $select = "SELECT * FROM `picture_banking` WHERE `ref_tech_store`='{$ref_tech_store}' AND `ref_id_tec`='{$ref_id_tec}' AND `ref_cus`='{$ref_cus}'";
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