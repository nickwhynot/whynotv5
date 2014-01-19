<?php

session_start();

$username = $_SESSION['user'];

	$con = mysqli_connect("localhost","root","root","whynotv4");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$usertagssql = "SELECT COUNT(Event) FROM UserHistory WHERE User='$username'";
	$data = mysqli_query($con, $usertagssql);
	$datarray = array();
	while($row = mysqli_fetch_array($data)) {
		$datarray[0] = $row[0];
	}

	$usertagssql = "SELECT COUNT(Event) FROM UserHistory WHERE (User='$username' AND Choice = '1')";
	$data = mysqli_query($con, $usertagssql);
	while($row = mysqli_fetch_array($data)) {
		$datarray[1] = $row[0];
	}
	$i = 2;

	$usertagssql = "SELECT UserName.RealName,COUNT(UserHistory.User) as `num` FROM UserHistory INNER JOIN UserName ON UserHistory.User=UserName.User WHERE (UserHistory.User != 'devrankaraca1@gmail.com' AND UserHistory.User != 'r.w.shimmin@gmail.com' AND UserHistory.User != 'kicks66@gmail.com' AND UserHistory.User != 'team@whynotapp.co.uk' AND UserHistory.User != '') GROUP BY UserName.RealName ORDER BY `num` DESC";
	$data = mysqli_query($con, $usertagssql);
	while($row = mysqli_fetch_array($data)) {
		$user = explode("@",$row['RealName']);
		$datarray[$i]['User'] = $user[0];
		$datarray[$i]['Count'] = $row['num'];
		$i = $i + 1;
	}

print_r(json_encode($datarray));

?>