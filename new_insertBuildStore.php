<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$post_data = file_get_contents("php://input");
    if(isset($post_data)){
        $request = json_decode($post_data,true);
        // $post_data['images'] = $request["images"] ;
        // $post_data['image_name'] = 'image_name';
            // if(!empty($post_data['images'])){
                    $img = str_replace('data:image/jpg;base64,','',$request["images"]);
                    $img = str_replace('','+',$img);
                    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i','',$img));
            //         // $target_file = $_SERVER['DOCUMENT_ROOT'].'/upload_image/mobile_pic/pic_'.$post_data['image_name'].'.jpg';
                    $name_img = "img/".uniqid().".jpg";//genatate nameImages 
                    file_put_contents($name_img,$data );
                    if(file_put_contents($name_img,$data)){
                            echo json_encode(array('msg'=>'success'));
                    }
                    else{
                        echo json_encode(array('msg'=>'fail'));
                    }
            // }
    }
?>