<?php
	include_once './config/database.php';

	$name = '';
	$email = '';
	$password = '';

	$data = json_decode(file_get_contents("php://input"));

	$name = $data->name;
	$email = $data->email;
	$password = $data->password;

	$password_hash = password_hash($password, PASSWORD_BCRYPT);

	$qry = "INSERT INTO `users` VALUES ('', '".$name."', '".$email."','".$password_hash."')";
	$qry_exec = mysqli_query($con, $qry);

	if($qry_exec){

	    http_response_code(200);
	    echo json_encode(array("message" => "User successfully registered."));
	}
	else{
	    http_response_code(400);

	    echo json_encode(array("message" => "Unable to register the user."));
	}
?>