<?php
include '../config/connect_DB.php';
$return = array();

	if (count($_GET) == 3 && isset($_GET['user']) && isset($_GET['password']) && isset($_GET['status'])) {
				$user = $_GET['user'];
				$password = $_GET['password'];
				$status = $_GET['status'];
	}
		$select = "SELECT * FROM `register` WHERE `user`='{$user}' AND `password` ='{$password}'";
		if ($res = mysqli_query($connection,$select)) {
			if (mysqli_num_rows($res)>0) {
				$return['message'] = "มีผู้ใช้รหัสผ่านนี้แล้ว";
				$return['status'] = false;
			}
			else{
				$insert = "INSERT INTO `register` (`id`, `user`, `password`, `status`) VALUES (NULL, '{$user}', '{$password}', '$status') ";
				if (mysqli_query($connection,$insert)) {	
					$return['message'] = "สมัคสมาชิกสำเร็จ";
					$return['status'] = true;
				}
			}
	}
	echo json_encode($return);
	mysqli_close($connection);
?>