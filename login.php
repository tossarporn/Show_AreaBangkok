<?php
include '../config/connect_DB.php';

header("Access-Control-Allow-Origin: *");
$input_data = file_get_contents("php://input");
$return = array();
$return['data_user'] = array();
$_POST = json_decode($input_data,true);

	if (count($_POST) == 2 && isset($_POST['user']) && isset($_POST['password'])) {
		$user = $_POST['user'];
		$password = $_POST['password'];
	
	}
	$select = "SELECT * FROM `register` WHERE `user`='{$user}' AND `password` ='{$password}' ";
	if ($res = mysqli_query($connection,$select)) {
		
		if (mysqli_num_rows($res) == 1) {
			$data = mysqli_fetch_assoc($res);
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