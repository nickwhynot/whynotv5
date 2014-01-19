<?php

function parsefoursq($foursquaredata) {
	$data = $foursquaredata['response']['venue'];
	$dataparsed['phone'] = $data['contact']['phone'];
	$dataparsed['twitter'] = $data['contact']['twitter'];
	$dataparsed['typeofplace'] = $data['categories'][0]['name'];
	$dataparsed['checkins'] = $data['stats']['checkinsCount'];
	$dataparsed['website'] = $data['url'];
	$dataparsed['foursqrating'] = $data['rating'];
	$dataparsed['foursqnumrating'] = $data['stats']['usercount'];
	$imagecount = $data['photos']['count'];
	if ($imagecount>6) {
		$imagecount = 6;
	}
	$dataparsed['imagecount'] = $imagecount;
	for ($i=0 ; $i<$imagecount ; $i++) {
		$dataparsed['images'][] = $data['photos']['groups'][1]['items'][$i]['url'];
	}
	$dataparsed['foursqdesc'] = $data['description'];
	$tipcount = $data['tips']['count'];
	if ($tipcount > 10) {
		$tipcount = 10;
	}
	$dataparsed['tipcount'] = $tipcount;
	if ($data['tips']['groups'][0]['type'] == 'following') {
		$dataparsed['tips'][0]['text'] = $data['tips']['groups'][0]['items'][0]['text'];
		$dataparsed['tips'][0]['name'] = $data['tips']['groups'][0]['items'][0]['user']['firstName'];
		$tipcount = $tipcount - 1;
		for ($j=0 ; $j<$tipcount ; $j++) {
			$dataparsed['tips'][] = ['text'=>$data['tips']['groups'][1]['items'][$j]['text'],'name'=>$data['tips']['groups'][1]['items'][$j]['user']['firstName']];
		}
	} else {
		for ($j=0 ; $j<$tipcount ; $j++) {
			$dataparsed['tips'][] = ['text'=>$data['tips']['groups'][0]['items'][$j]['text'],'name'=>$data['tips']['groups'][0]['items'][$j]['user']['firstName']];
		}
	}
	if ($data['attributes']['groups'][0]['type'] == 'price') {
		$dataparsed['price'] = $data['attributes']['groups'][0]['summary'];
	}
	return $dataparsed;
}

?>