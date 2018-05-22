<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details = [];

        if(isset($_POST['ref_tec']) && isset($_POST['ref_regis']) && isset($_POST['rating'])){
           
            $ref_tec = $_POST['ref_tec'];
            $ref_regis = $_POST['ref_regis'];
            $rating = $_POST['rating'];

        }


        $select_insert = "SELECT * FROM `complacent`  WHERE `ref_tec`='{$ref_tec}' and `ref_regis`='{$ref_regis}' and `rating`='{$rating}'";

        if($qur_update = mysqli_query($connection,$select_insert)){
            if($res_update = mysqli_num_rows($qur_update)  !=0)
                {
                $details['message'] = "ประเมินคะแนนไปแล้ว_update";
                $details['status'] = false;
                }
                else{
                    
                    $update = "UPDATE `complacent` SET  ref_regis ='{$ref_regis}', rating='{$rating}' WHERE ref_tec='{$ref_tec}'";
                    $qury_update = mysqli_query($connection,$update);
                    $details['message'] = "ประเมินคะแนนสำเร็จ";
                    $details['status'] = true;
                    }
            }
 
        else
            {
            $details['message'] = "กรุณาให้คะแนน";
            $details['status'] = false;
            }
        echo json_encode($details);
        mysqli_close($connection);
?>