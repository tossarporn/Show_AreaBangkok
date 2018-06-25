<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$details = [];

        if(isset($_POST['ref_tec']) && isset( $_POST['ref_id']) && isset($_POST['ref_regis']) && isset($_POST['rating'])){
           
            $ref_tec = $_POST['ref_tec'];
            $ref_id = $_POST['ref_id'];
            $ref_regis = $_POST['ref_regis'];
            $rating = $_POST['rating'];

        }
        $select = "SELECT * FROM `complacent`  WHERE `ref_tec`='{$ref_tec}' and `ref_regis`='{$ref_regis}'";
        // echo $select;
        if($res = mysqli_query($connection,$select))
        {
            if(mysqli_num_rows($res)>0)
                {
                $details['message'] = "ประเมินคะแนนไปแล้ว";
                $details['status'] = false;

                }
            else
                {
                $insert = "INSERT INTO `complacent` (`id`, `ref_id`, `ref_tec`, `ref_regis`, `rating`) VALUES (NULL, '{$ref_id}', '{$ref_tec}', '{$ref_regis}', '{$rating}');";
                $qury_insert = mysqli_query($connection, $insert);
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