<?php

function geocodepost($post) {
	$postcode = str_replace(' ','',$post);

	$latlong = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $postcode . '&sensor=false'),true);

	$lat = $latlong['results'][0]['geometry']['location']['lat'];
	$long = $latlong['results'][0]['geometry']['location']['lng'];

	return [$lat,$long];
}

?>