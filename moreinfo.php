<?php

$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();

include('getyelp.php');
include('parseinfo.php');

$id = $_SESSION['suggestion']['id'];
$info = getbus($id);
print_r(json_encode(parseinfo($info),true));

?>