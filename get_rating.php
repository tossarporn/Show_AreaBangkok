<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);
$detail = [];

$rating['data_rating'] = array (
            
    ["num_rating"=>'1',"rating"=>'1'],
    ["num_rating"=>'2',"rating"=>'2'],
    ["num_rating"=>'3',"rating"=>'3'],
    ["num_rating"=>'4',"rating"=>'4'],
    ["num_rating"=>'5',"rating"=>'5 '],
    );
    if(isset($_POST['ref_id'])){
            $ref_id = $_POST['ref_id'];
        }

    $array_usesed = [];
    foreach ($rating['data_rating'] as $key => $data_rating){

        $select = "SELECT COUNT(*) AS count_star,rating  
        FROM complacent 
        WHERE `ref_tec`='{$ref_id}' GROUP BY rating asc "  ;

        if($res = mysqli_query($connection,$select)){
            while ($row = mysqli_fetch_assoc($res)){
                $array_usesed[] = $row["count_star"];
            }
        }
    }

// if(isset($_POST['ref_id'])){
//     $ref_id = $_POST['ref_id'];
// }

// $select = "SELECT COUNT(*) AS count_star,rating FROM complacent WHERE `ref_id`='{$ref_id}' GROUP BY rating" ;
    
//     if($res = mysqli_query($connection,$select)){
//         while($row = mysqli_fetch_assoc($res)){

//             $detail[]= $row;    
//         }

//     }

//     else{
//         $detail['message'] = 'ไม่สามารถติดต่อกับข้อมูลได้';
    
//     }
    echo json_encode($array_usesed);
?>