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
        $select="SELECT * FROM `customerforrent` INNER JOIN guest_register ON customerforrent.ref_regis = guest_register.id  WHERE guest_register.id = '{$ref_regis}'
        ";

        if($res = mysqli_query($connection,$select)){
            
            // $insert = "INSERT INTO `customerforrent` (`id`, `name`, `lastname`, `equipment`, `house_number`, `street`, `distric`, `tel`, `area`, `date of service`, `ref_tec`, `ref_regis`, `ref_id_tec`) 
            // VALUES (NULL, '{$name_guest}', '{$last_name_guest}', '{$equipment}', '{$num_house}', '{$street}', '{$dristric}', '{$tel}', '{$area}', '{$date}', '{$ref_tec}', '{$ref_regis}', '{$ref_id_tec}');";
            // $qury_insert = mysqli_query($connection,$insert);
            // $details['message'] = "จองสำเร็จ";
            // $details['status'] = true;

           
            $update_details = "UPDATE `guest_register` SET `status_seg`='{$status_seg}',`check_tus`='{$check_tus}'  WHERE guest_register.id = '{$ref_regis}'";
            $insert_details = "INSERT INTO `customerforrent` (`id`, `name`, `lastname`, `equipment`, `house_number`, `street`, `distric`, `tel`, `area`, `date_service`, `ref_tec`, `ref_regis`, `ref_id_tec`) 
            VALUES (NULL, '$name_guest', '$last_name_guest', '$equipment', '$num_house', '$street', '$dristric', '$tel', '$area ', ' $date', '$ref_tec', '$ref_regis', '$ref_id_tec');";
                $details['message'] = "จองสำเร็จ";
                $details['status'] = true;
                $query = mysqli_query($connection,$update_details);
                $query = mysqli_query($connection,$insert_details);
        }
       
       else{
        $details['message'] = "ไม่สามารถติดต่อกลับข้อมูลได้";
       }
        echo json_encode($details);
        mysqli_close($connection);
?>