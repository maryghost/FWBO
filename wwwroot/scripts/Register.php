<?php

//variables
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$emailAddress = $_POST['emailAddress'];
$password = md5($_POST['password']);
$age = $_POST['age'];
$birth_date =  $_POST['bday'];

$resp = new stdClass;
$resp->status = false;

//****CONNECTING TO DATABASE****//
$connectionInfo = array("UID" => "DevTeam@flywithbutchohareserver", "pwd" => "Developers#60666", "Database" => "FlyWithButchOhareDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:flywithbutchohareserver.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
	
//**TESTING CONNECTION**//
if( $conn === false ) {
	$resp->message = print_r( sqlsrv_errors(), true);
}
else {	
	//**RUNNING QUERY**//
	$sql = "SELECT * FROM accounts WHERE email = ? AND password = ?";
	$stmt = sqlsrv_prepare( $conn, $sql, array( $emailAddress, $password));
	sqlsrv_execute($stmt);	
	//**TESTING IF QUERY WAS SUCCESSFULL**//
	if( $stmt === false ) {
		$resp->message = print_r( sqlsrv_errors(), true);
	}
	//**COMPARING RESULTS**//
	if ($stmt) {
		$rows = sqlsrv_has_rows( $stmt );
		if ($rows === true) {
			$resp->message = "You have already registered, please log in";
		} else {
			$resp->status = true;
			$sql = "INSERT INTO accounts(first_name,last_name,email,password,age,birth_date)VALUES(?,?,?,?,?,?)";
			$stmt = sqlsrv_prepare( $conn, $sql, array( &$fName, &$lName, &$emailAddress, &$password, &$age, &$birth_date));
			sqlsrv_execute($stmt);
			

			$resp->message = "You have been successfully registered, please log in and enjoy the games!";
			
			//$debug = "INSERT INTO accounts(first_name,last_name,email,password,age,birth_date) VALUES('{$fName}','{$lName}','{$emailAddress}','{$password}','{$age}','{$birth_date}')";
			//echo $debug;
		}
	}
}
die(json_encode($resp));
?>