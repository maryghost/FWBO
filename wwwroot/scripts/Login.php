<?php
	
$username = $_POST['username'];
$password = md5($_POST['password']);

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
	$stmt = sqlsrv_prepare( $conn, $sql, array( &$username, &$password));
	sqlsrv_execute($stmt);	
	//**TESTING IF QUERY WAS SUCCESSFULL**//
	if( $stmt === false ) {
		$resp->message = print_r( sqlsrv_errors(), true);
	}
		
	//**COMPARING RESULTS**//
	if ($stmt) {
		$rows = sqlsrv_has_rows( $stmt );
		if ($rows === true) {
			$_SESSION['email']=$row['email'];
			$resp->status = true;
			session_start();
			// This is optional - we are not currently using it in the front end but in case you do 
			// $resp->message = "YOU HAVE LOGGED IN SUCCESSFULLY\r\n";
		} else {
			$resp->message = "Wrong Username or Password";
		}
	}
}
die(json_encode($resp));