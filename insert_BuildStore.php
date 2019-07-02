<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$return = array();
$_POST = json_decode($data,true);
// exec("echo{$file_content}>>log2.txt");
		if( isset($_POST['name_store'])&&isset($data))
		{
				$name_store = $_POST['name_store'];
				$name_tech = $_POST['name_tech'];
				$lastname_tech = $_POST['lastname_tech'];
				$name_account = $_POST['name_account'];
				$lastname_account = $_POST['lastname_account'];
				$account = $_POST['account'];
				$equipment = $_POST['equipment'];//ref_type 
				$tel = $_POST['tel'];
				$time_start = $_POST['time_start'];
				$time_end = $_POST['time_end'];
				$cost_begin = $_POST['cost_begin'];
				$num_house = $_POST['num_house'];
				$street = $_POST['street'];
				$distric = $_POST['distric'];
				$area = $_POST['area'];//ref_area
				// $lat = $_POST['lat'];
				// $lng = $_POST['lng'];
				$tec_id = $_POST['tec_id'];
				$img = str_replace('data:image/jpg;base64,','',$_POST["images"]);
				$img = str_replace('','+',$img);
				$base_64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i','',$img));
				$name_img = "img/".uniqid().".jpg";
				$file_content = file_put_contents($name_img,$base_64);

				$select = "SELECT * FROM `technician_store` WHERE name_store = '{$name_store}'";
					if ($res = mysqli_query($connection,$select)) {
						if (mysqli_num_rows($res)>0) {
							$return['message'] = "มีผู้ใช้แล้ว";
							$return['status'] = false;
						}
						else{
							$insert ="INSERT INTO `technician_store` (`id`, `name_store`,`name_tech`,`lastname_tech`,`ref_type`, `ref_area`, `ref_regis_tec`,`name_account`,`lastname_account`, `account_bank`, `home_number`, `street`, `district`, `image_name`, `time_start`, `time_end`, `tel_technician`, `cost_begin`) 
							VALUES (NULL,'{$name_store}','{$name_tech}','{$lastname_tech}','{$equipment}', '{$area}','{$tec_id}','{$name_account}','{$lastname_account}','{$account}','{$num_house}','{$street}','{$distric}','{$name_img}','{$time_start}','{$time_end}','{$tel}','{$cost_begin}')";
								mysqli_query($connection,$insert);
								$return['message'] = "สร้างร้านค้าสำเร็จ";
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