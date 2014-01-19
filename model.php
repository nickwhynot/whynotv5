<?php

$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();

include('getyelp.php');
include('getuser.php');
include('sanitise.php');
include('rank.php');
include('parse.php');
include('sort.php');
include('lastfm.php');
include('getdist.php');
include('foursqid.php');
include('foursquare.php');
include('geocode.php');

$user = $_SESSION['user'];
$lat = $_SESSION['lat'];
$long = $_SESSION['long'];
$cat = $_SESSION['cat'];
$place = $_SESSION['place'];
$radius = 2000;
$refresh = $_SESSION['refresh'];

if ($cat == 'gigs') {
	if ($refresh=='true') {
		$places = getlastfm($lat,$long,3);
		$places = parselastfm($places);
		$_SESSION['refresh'] = 'false';
	} else {
		$places = $_SESSION['places'];
	}
} else {
//GET YELP DATA
	if ($refresh=='true') {
		$places = getyelpall($lat,$long,$cat,$radius);
		$places = parseyelp($places);
		$_SESSION['refresh'] = 'false';
	} else {
		$places = $_SESSION['places'];
	}
}

print_r($_SESSION);

//users history
$userevents = getevents($user);

//sanitise data
//yelp
$places = sanitise($places,$userevents);

// get user tags
$usertags = gettags($user);

// weight yelp
for ($i=0 ; $i<count($places) ; $i++) {
	$places[$i] = weight($places[$i],$usertags);
}

//sort yelp
$places = sortevents($places);

$places = array_values($places);
$_SESSION['places'] = $places;

$userlat = $_SESSION['userlat'];
$userlong = $_SESSION['userlong'];

//display top
$suggestion = $places[0];
$postcode = $suggestion['postcode'];

//enrich with foursquare
//geocode to get lat long
$latlong = geocodepost($postcode);
$suggestion['latlong'] = $latlong;

//get foursquare id
$foursqid = getfoursqid($latlong[0],$latlong[1],$suggestion['name']);
$suggestion['foursqid'] = $foursqid;

//get foursquare data
$foursqdata = getfoursqbus($foursqid);

//parse foursquare
$foursq = parsefoursq($foursqdata);

$suggestion = array_merge($foursq,$suggestion);

$dist = getdist($latlong[0],$latlong[1],$userlat,$userlong);
$suggestion['dist'] = $dist;
$suggestion['cat'] = $cat;
$_SESSION['suggestion'] = $suggestion;

print_r(json_encode($suggestion));

?>