<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

    if(isset($_POST['tec_id'])){
        $select = "SELECT * FROM `customerforrent` 
        WHERE `ref_id_tec`='".$_POST['tec_id']."'
         
        ORDER BY `date of service` DESC
        ";
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

    // function get_all_equipment($ref_id_tec,$connection){
    //     $select = "SELECT count(*) 
    //         as service_count,`equipment`,`date of service` 
    //         FROM `customerforrent` 
    //         WHERE `ref_id_tec`='{$ref_id_tec}' 
    //         GROUP BY `date of service`" ;
    
    // if($res = mysqli_query($connection,$select)){
    //     while($row = mysqli_fetch_assoc($res)){
    //         $detail[]= $row;
    //         }
    //     }
    //     return $ref_id_tec;
    // }
?>