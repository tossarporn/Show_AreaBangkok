<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$return = array();
$_POST = json_decode($data,true);

if( isset($_POST['ref_tech_store'])&& isset($_POST['ref_id_tec']) && isset($_POST['ref_cus']) && isset($_POST['date_img'])){

    $ref_tech_store = $_POST['ref_tech_store'];
    $ref_id_tec = $_POST['ref_id_tec'];
    $ref_cus = $_POST['ref_cus'];
    $date_img = $_POST['date_img'];

    $img = str_replace('data:image/jpg;base64,','',$_POST["img_tax"]);
    $img = str_replace('','+',$img);
    $base_64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i','',$img));
    $name_img = "img/".uniqid().".jpg";
    $file_content = file_put_contents($name_img,$base_64);

    $select = "SELECT * FROM `picture_banking` WHERE ref_cus = '{$ref_cus}'";

    if ($res = mysqli_query($connection,$select)) {
        if (mysqli_num_rows($res)>0) {
            $return['message'] = "มีผู้ใช้แล้ว";
            $return['status'] = false;
        }
        else{
            $insert ="INSERT INTO `picture_banking` (`id`, `ref_tech_store`, `ref_id_tec`, `ref_cus`,`name_img_tax_invoice`,`date_img`) 
            VALUES (NULL,'{$ref_tech_store}','{$ref_id_tec}','{$ref_cus}','{$name_img}','{$date_img}')";
            // $insert = "UPDATE `customerforrent` SET `img_tax`='{$name_img}' WHERE `ref_regis` ='{$ref_cus}'";
                mysqli_query($connection,$insert);
                $return['message'] = "อัพเดตสำเร็จ";
                $return['status'] = true;
        }
}
else{
                $return['message'] = "ไม่สามารถติดต่อข้อมูลได้";
                $return['status'] = false;
    }
}

    echo json_encode($return);
	mysqli_close($connection);
?>