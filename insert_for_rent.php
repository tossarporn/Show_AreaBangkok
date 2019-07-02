<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

        if(isset($_POST['id_store']) && isset($_POST['ref_tec']))
        {
            $guest_name = $_POST['guest_name'];
            $guest_lastname = $_POST['guest_lastname'];
            $type_name = $_POST['type_name'];
            $home_number = $_POST['home_number'];
            $street = $_POST['street'];
            $district = $_POST['district'];
            $area_name = $_POST['area_name'];
            $tel = $_POST['tel'];
            $mydate = $_POST['mydate'];
            $id_store = $_POST['id_store'];
            $ref_regis = $_POST['ref_regis'];
            $ref_tec = $_POST['ref_tec'];
            $check_tus = $_POST['check_tus'];
        }
            $select = "SELECT * FROM `customerforrent` INNER JOIN guest_register ON customerforrent.ref_regis = guest_register.id  WHERE guest_register.id = '{$ref_regis}'";
            if($res = mysqli_query($connection,$select)){   
                $update_rent = "UPDATE `guest_register` SET `check_tus`='{$check_tus}',`ref_store`='{$id_store}'WHERE `id`='{$ref_regis}'"; 
                 $insert_rent = "INSERT INTO `customerforrent` (`id`, `name`, `lastname`, `equipment`, `house_number`, `street`, `distric`, `area`, `tel`, `date_service`, `ref_tec`, `ref_regis`, `ref_id_tec`) 
                 VALUES (NULL, '$guest_name', '$guest_lastname', '$type_name', '$home_number', '$street', '$district', '$area_name', '$tel', '$mydate', '$id_store', '$ref_regis', '$ref_tec');";
                $detail['message'] = "เพิ่มข้อมูลสำเร็จ";
                $detail['status'] = true;
                $qury_insert = mysqli_query($connection,$update_rent);
                $qury_insert = mysqli_query($connection, $insert_rent);
            }
            else{
                $detail['message'] = "เพิ่มข้อมูลล้มเหลว";
                $detail['status'] = false;
            }
            echo json_encode($detail);
            mysqli_close($connection);
?>