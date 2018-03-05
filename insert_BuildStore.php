<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$return = array();
$_POST = json_decode($data,true);
exec("echo{$data }>>log2.txt");
		if( isset($_POST['name_store'])&&isset($data))
		{
				$name_store = $_POST['name_store'];
				$account = $_POST['account'];
				$equipment = $_POST['equipment'];//ref_type 
				$tel = $_POST['tel'];
				$time_start = $_POST['time_start'];
				$time_end = $_POST['time_end'];
				$cost_begin = $_POST['cost_begin'];
				$num_house = $_POST['num_house'];
				$street = $_POST['street'];
				$distric = $_POST['distric'];
				// $images = $_POST['images'];//error
				$area = $_POST['area'];//ref_area
				$lat = $_POST['lat'];
				$lng = $_POST['lng'];
			// $new_image = $_FILES['images']['name'];//error
			// $new_image_temp = $_FILES['images']['tmp_name'];//error
			// $request = json_decode($data,true);
				$img = str_replace('data:image/jpg;base64,','',$_POST["images"]);
				$img = str_replace('','+',$img);
				$base_64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i','',$img));
				$name_img = "img/".uniqid().".jpg";
				$file_content = file_put_contents($name_img,$base_64);

				$select = "SELECT * FROM `technician_store` WHERE `name_store` = '{$name_store}'";
					if ($res = mysqli_query($connection,$select)) {
						if (mysqli_num_rows($res)>0) {
							$return['message'] = "มีผู้ใช้แล้ว";
							$return['status'] = false;
						}
						else{
							$insert = "INSERT INTO `technician_store` (`id`, `name_store`, `ref_type`, `ref_area`, `account bank`, `image_name`,`home_number`, `street`, `district`, `time_start`, `time_end`, `tel_technician`, `cost_begin`, `lat`, `lng`) 
							VALUES (NULL, '{$name_store}', '{$equipment}', '{$area}','{$account}','{$num_house}','{$street}','{$name_img}','{$distric}','{$time_start}','{$time_end}','{$tel}','{$cost_begin}','{$lat}','{$lng}') ";
							if (mysqli_query($connection,$insert)) {	
								$return['message'] = "สมัคสมาชิกสำเร็จ";
								$return['status'] = true;
							}
						}
				}
		}
		
		
	echo json_encode($return);
	mysqli_close($connection);

?>