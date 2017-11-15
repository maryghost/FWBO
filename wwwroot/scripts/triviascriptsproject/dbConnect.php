<?php
$resp = new stdClass;
$resp->status = false;

//****CONNECTING TO DATABASE****//
$connectionInfo = array("UID" => "DevTeam@flywithbutchohareserver", "pwd" => "Developers#60666", "Database" => "FlyWithButchOhareDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:flywithbutchohareserver.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
	
//**TESTING CONNECTION**//
if ($conn)
{
	// DEBUG
	//echo "Connection successful.<br>";
}
else 
{
	$resp->message = print_r( sqlsrv_errors(), true);
	die(json_encode($resp));
}

?>