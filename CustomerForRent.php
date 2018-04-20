<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,TRUE);
$details = [];
    if(isset($_POST['ref_tec']) && isset($_POST['ref_regis'])){
            // $id = $_POST['id'];
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
            $ref_regis = $_POST['ref_regis'];}
        $select="SELECT * FROM `customerforrent` INNER JOIN register ON customerforrent.ref_regis = register.id WHERE `ref_tec`='{$ref_tec}'";
        if($res = mysqli_query($connection,$select)){
            if (mysqli_num_rows($res)>0) {
                $details['message'] = "ไม่สามารถทำการจองได้";
                $details['status'] = false;
        }

            else{
                $insert = "INSERT INTO `customerforrent` (`id`, `name`, `lastname`,`equipment` ,`house_number`, `street`, `distric`, `area`, `tel`, `date of service`, `ref_tec`, `ref_regis`) 
                VALUES (NULL,'{$name_guest}', '{$last_name_guest}','{$equipment}', '{$num_house}', '{$street}', '{$dristric}', '{$area}', '{$tel}', '{$date}', '{$ref_tec}', '{$ref_regis}');";
            $qury_insert = mysqli_query($connection,$insert);
            $details['message'] = "จองสำเร็จ";
            $details['status'] = true;
            }
        }
       
       else{
        $details['message'] = "ไม่สามารถติดต่อกลับข้อมูลได้";
       }
       echo json_encode($details);
        mysqli_close($connection);
?>