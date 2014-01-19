<?php

function getfoursqid($lat,$long,$name) {
	$name = str_replace(' ','%20',$name);
	$foursq = json_decode(file_get_contents('https://api.foursquare.com/v2/venues/search?intent=match&v=20140110&ll=' . $lat . ',' . $long . '&query=' . $name . '&client_id=YUDM3T0DG0DQLUM0J3V0TTIWWSAYJWUKIJCB1LGK4XR1FNCX&client_secret=K0OYN0E1WUE4DJF2SRS0YADXD34CCRUFSLP430KSML0P0GUE'),true);
	return ($foursq['response']['venues'][0]['id']);
}

?>