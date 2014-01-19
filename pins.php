<?php

$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();

$suggestion = $_SESSION['suggestion'];
$name = $suggestion['name'];
$user = $_SESSION['user'];
$image = $suggestion['image'];
$url = $suggestion['url'];

$json = $_POST;
$choice = $json['pin'];

$con = mysqli_connect("aarv6gcxs2fign.cz4enrv4fad3.eu-west-1.rds.amazonaws.com","root","ladsonline1","whynotv4");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$insertpins = "INSERT IGNORE INTO `Pins`(`User`, `Event`, `Image`, `URL`) VALUES ('$user','$name','$image','$url')";
mysqli_query($con,$insertpins);

?>