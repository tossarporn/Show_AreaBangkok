<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

        if(count($_POST) == 4 && isset($_POST['ref_tec']) && ($_POST['ref_regis']) && ($_POST['ref_id_tec']) && ($_POST['status_seg']))
        {
           
            // $ref_regis = $_POST['name'];
            // $ref_id_tec = $_POST['lastname'];
            // $status_seg = $_POST['equipment'];
            // $ref_tec = $_POST['house_number'];
            // $ref_regis = $_POST['street'];
            // $ref_id_tec = $_POST['distric'];
            // $status_seg = $_POST['tel'];
            // $ref_tec = $_POST['area'];
            // $ref_tec = $_POST['date of service'];

            $ref_tec = $_POST['ref_tec'];
			$ref_regis = $_POST['ref_regis'];
			$ref_id_tec = $_POST['ref_id_tec'];
            $status_seg = $_POST['status_seg'];
        }
            $select = "SELECT `ref_tec`,`ref_regis`,`ref_id_tec`,`status_seg` FROM `customerforrent` 
            WHERE `ref_tec`='{$ref_tec}'AND`ref_regis`='{$ref_regis}' AND`ref_id_tec`='{$ref_id_tec}' AND `status_seg`='{$status_seg}'";
        
            if($res = mysqli_query($connection,$select)){
                
                $insert_rent = "INSERT INTO `customerforrent` (`ref_tec`, `ref_regis`, `ref_id_tec`, `status_seg`) 
                VALUES ('$ref_tec', '$ref_regis', '$ref_id_tec', '$status_seg');";
                 $qury_insert = mysqli_query($connection,$insert_rent);
                $detail['message'] = "เพิ่มข้อมูลสำเร็จ";
				$detail['status'] = true;
            }
            else{
                $detail['message'] = "เพิ่มข้อมูลล้มเหลว";
                $detail['status'] = false;
            }
            echo json_encode($detail);
            mysqli_close($connection);
?>