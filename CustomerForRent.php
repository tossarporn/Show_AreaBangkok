<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,TRUE);
$details = [];
    if(isset($_POST['ref_tec']) && isset($_POST['ref_regis'])){
            $name_guest = $_POST['name_guest'];
            $last_name_guest = $_POST['last_name_guest'];
            $equipment = $_POST['equipment'];
            $num_house = $_POST['num_house'];
            $street = $_POST['street'];
            $dristric = $_POST['ditstric'];
            $area = $_POST['area'];
            $date = $_POST['date'];
            $tel = $_POST['tel'];
            $ref_tec = $_POST['ref_tec'];
            $ref_regis = $_POST['ref_regis'];
            $ref_id_tec = $_POST['ref_id_tec'];
            $status_seg = $_POST['status_seg'];
            $check_tus = $_POST['check_tus'];
        }
        $select="SELECT * FROM `customerforrent` INNER JOIN register ON customerforrent.ref_regis = register.id";

        if($res = mysqli_query($connection,$select)){
            
            // $insert = "INSERT INTO `customerforrent` (`id`, `name`, `lastname`, `equipment`, `house_number`, `street`, `distric`, `tel`, `area`, `date of service`, `ref_tec`, `ref_regis`, `ref_id_tec`) 
            // VALUES (NULL, '{$name_guest}', '{$last_name_guest}', '{$equipment}', '{$num_house}', '{$street}', '{$dristric}', '{$tel}', '{$area}', '{$date}', '{$ref_tec}', '{$ref_regis}', '{$ref_id_tec}');";
            // $qury_insert = mysqli_query($connection,$insert);
            // $details['message'] = "จองสำเร็จ";
            // $details['status'] = true;

            // $insert = "INSERT INTO `customerforrent` (`id`, `name`, `lastname`, `equipment`, `house_number`, `street`, `distric`, `tel`, `area`, `date of service`, `ref_tec`, `ref_regis`, `ref_id_tec`,`status_seg`) 
            // VALUES (NULL, '$name_guest', '$last_name_guest', '$equipment', '$num_house', '$street', '$dristric', '$tel', '$area ', ' $date', '$ref_tec', '$ref_regis', '$ref_id_tec','$status_seg');";
            //   $qury_insert = mysqli_query($connection,$insert);
            //   $details['message'] = "จองสำเร็จ";
            //   $details['status'] = true;

        $update_guest = "UPDATE `customerforrent` SET `name`='{$name_guest}',`lastname`='{$last_name_guest}',
        `equipment`='{$equipment}',`house_number`='{$num_house}',`street`='{$street}',`distric`='{$dristric}',
        `tel`='{$tel}',`area`='{$area}',`date of service`='{$date}',`ref_tec`='{$ref_tec}',
        `ref_regis`='{$ref_regis}',`ref_id_tec`='{$ref_id_tec}',`status_seg`='{$status_seg}',`check_tus`='{$check_tus}' WHERE `ref_regis` ='{$ref_regis}'";
                $details['message'] = "จองสำเร็จ";
                $details['status'] = true;
                $query = mysqli_query($connection,$update_guest);
        }
       
       else{
        $details['message'] = "ไม่สามารถติดต่อกลับข้อมูลได้";
       }
        echo json_encode($details);
        mysqli_close($connection);
?>