<?php

include('parsefoursq.php');

function getfoursqbus($id) {
	$data = json_decode(file_get_contents('https://api.foursquare.com/v2/venues/' . $id . '?oauth_token=NTZIIUJPZATDUIHAERTEJNOHDPZU4PITUXTX3QZCL5KTVH2X'),true);
	return $data;
}

$data = getfoursqbus('4d000afb21ea6ea817ce3f9f');

parsefoursq($data);

?>