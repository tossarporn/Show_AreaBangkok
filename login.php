<?php
include '../config/connect_DB.php';

header("Access-Control-Allow-Origin: *");
$input_data = file_get_contents("php://input");
$return = array();
$return['data_user'] = array();
$_POST = json_decode($input_data,true);

	if (count($_POST) == 3 && isset($_POST['user']) && isset($_POST['password'])&& isset($_POST['status'])) {
		$user = $_POST['user'];
		$password = $_POST['password'];
		$status = $_POST['status'];

	}
	if($status == 1){
		$guest_select = "SELECT * FROM `guest_register`  WHERE `username`='{$user}' AND `password`='{$password}' AND `status` = '{$status}'";
		$quer_guest = mysqli_query($connection,$guest_select);
		
		if(mysqli_num_rows($quer_guest) == 1){
			$data = mysqli_fetch_assoc($quer_guest);
			$return['data_user'] = $data;
			$return['status'] = true;
			$return['message'] = "ยินดีต้อนรับเข้าสู่ระบบ";
		}
		else{
			$return['status'] = false;
			$return['message'] = "ไม่มีผู้ใช้อยู่ในระบบ";
		}
}
 elseif($status == 2){

	$tec_select= "SELECT * FROM `technician_store` WHERE `username`='{$user}' AND `password`='{$password}' AND `status` = '{$status}'";
	$quer_tec = mysqli_query($connection,$tec_select);

			if(mysqli_num_rows($quer_tec) == 1){
				$data = mysqli_fetch_assoc($quer_tec);
				$return['data_user'] = $data;
				$return['status'] = true;
				$return['message'] = "ยินดีต้อนรับเข้าสู่ระบบ";
			}
			else{
				$return['data_user'] = array();
			$return['status'] = false;
			$return['message'] = "ไม่มีผู้ใช้อยู่ในระบบ";
			}
	}
	
	else{
		$return['status'] = false;
		$return['message'] = "ไม่สามารถติดต่อกับระบบได้";
	}
		
		echo json_encode($return);
		mysqli_close($connection);	
?>