<?php

$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();

$username = $_SESSION['user'];

	$con = mysqli_connect("aarv6gcxs2fign.cz4enrv4fad3.eu-west-1.rds.amazonaws.com","root","ladsonline1","whynotv4");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$usertagssql = "SELECT Event, Image, URL FROM Pins WHERE User='$username'";
	$data = mysqli_query($con, $usertagssql);
	$datarray = array();
	$i = 0;
	while($row = mysqli_fetch_array($data)) {
		$datarray[$i]['Event'] = $row['Event'];
		$datarray[$i]['Image'] = $row['Image'];
		$datarray[$i]['url'] = $row['URL'];
		$i = $i+1;
	}

print_r(json_encode($datarray));

?>