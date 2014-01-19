$(document).ready(function() {
	$.getJSON('model.php',function(data) {
		$('#name').text(data['name']);
		var imagedots = '';
		imagedots = "<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
		for (var i = 1; i<=data['imagecount'] ; i++) {
			imagedots += "<li data-target='#carousel-example-generic' data-slide-to='" + i + "'></li>";
		}
		var imagetext = '';
		imagetext = "<div class='item active peopleCarouselImg'><img src='" + data['images'][0] + "' alt='' id='image1' height='50%' class='img-responsive img-thumbnail'></div>";
		for (var i = 1; i<data['imagecount'] ; i++) {
			imagetext += "<div class='item peopleCarouselImg'><img src='" + data['images'][i] + "' alt='' id='image" + i + "' height='50%' class='img-responsive img-thumbnail'></div>";
		}
		$('#imagecarousel').html(imagetext);
		if (String(data['foursqdesc']) == 'null') {
			$('#topreview').text(data['desc']);
		} else {
			$('#topreview').text(data['foursqdesc']);
		}
		$('#type').text(data['typeofplace'] + " - " + data['dist'] + " mins walk - " + Math.round(data['foursqrating']*10) + "%");
		$('#tips').text(data['tips'][0]['text']);
		var k = 1;
		$('#tipname').text(data['tips'][0]['name']);
		$('#right').on("click",function() {
			$('#tipname').text(data['tips'][k]['name']);
			$('#tips').text(data['tips'][k]['text']);
			k = k + 1;
			if (k>=data['tipcount']) {
				k = 0;
			}
		});
		$('#left').on("click",function() {
			k = k - 1;
			if (k<0) {
				k = Number(data['tipcount']);
			}
			$('#tipname').text(data['tips'][k]['name']);
			$('#tips').text(data['tips'][k]['text']);
		});
		$('#map').attr('src',"https://maps.googleapis.com/maps/api/staticmap?center=" + data['postcode'] + "&size=500x400&zoom=16&markers=color:red|" + data['postcode'] + "&sensor=false&key=AIzaSyAaKsyipdH7qWdbo8n7ZkdbUzqwdZatus4");
	});
$('#like').on("click",function() {
		$.ajax({
			type: "POST",
			url: "addtodb.php",
			dataType: 'json',
			data: {'choice': '1'}
		});
		$.getJSON('model.php',function(data) {
		$('#name').text(data['name']);
		var imagedots = '';
		imagedots = "<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
		for (var i = 1; i<=data['imagecount'] ; i++) {
			imagedots += "<li data-target='#carousel-example-generic' data-slide-to='" + i + "'></li>";
		}
		var imagetext = '';
		imagetext = "<div class='item active peopleCarouselImg'><img src='" + data['images'][0] + "' alt='' id='image1' height='50%' class='img-responsive img-thumbnail'></div>";
		for (var i = 1; i<data['imagecount'] ; i++) {
			imagetext += "<div class='item peopleCarouselImg'><img src='" + data['images'][i] + "' alt='' id='image" + i + "' height='50%' class='img-responsive img-thumbnail'></div>";
		}
		$('#imagecarousel').html(imagetext);
		if (String(data['foursqdesc']) == 'null') {
			$('#topreview').text(data['desc']);
		} else {
			$('#topreview').text(data['foursqdesc']);
		}
		$('#type').text(data['typeofplace'] + " - " + data['dist'] + " mins walk - " + Math.round(data['foursqrating']*10) + "%");
		$('#tips').text(data['tips'][0]['text']);
		var k = 1;
		$('#tipname').text(data['tips'][0]['name']);
		$('#right').on("click",function() {
			$('#tipname').text(data['tips'][k]['name']);
			$('#tips').text(data['tips'][k]['text']);
			k = k + 1;
			if (k>=data['tipcount']) {
				k = 0;
			}
		});
		$('#left').on("click",function() {
			k = k - 1;
			if (k<0) {
				k = Number(data['tipcount']);
			}
			$('#tipname').text(data['tips'][k]['name']);
			$('#tips').text(data['tips'][k]['text']);
		});
	$('#map').attr('src',"https://maps.googleapis.com/maps/api/staticmap?center=" + data['postcode'] + "&size=500x400&zoom=16&markers=color:red|" + data['postcode'] + "&sensor=false&key=AIzaSyAaKsyipdH7qWdbo8n7ZkdbUzqwdZatus4");
	});
});
$('#dislike').on("click",function() {
		$.ajax({
			type: "POST",
			url: "addtodb.php",
			dataType: 'json',
			data: {'choice': '-1'}
		});
		$.getJSON('model.php',function(data) {
		$('#name').text(data['name']);
		var imagedots = '';
		imagedots = "<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
		for (var i = 1; i<=data['imagecount'] ; i++) {
			imagedots += "<li data-target='#carousel-example-generic' data-slide-to='" + i + "'></li>";
		}
		imagedots += "<li data-target='#carousel-example-generic' data-slide-to='" + (i+1) + "'></li>";
		var imagetext = '';
		imagetext = "<div class='item active peopleCarouselImg'><img src='" + data['images'][0] + "' alt='' id='image1' height='50%' class='img-responsive img-thumbnail'></div>";
		for (var i = 1; i<data['imagecount'] ; i++) {
			imagetext += "<div class='item peopleCarouselImg'><img src='" + data['images'][i] + "' alt='' id='image" + i + "' height='50%' class='img-responsive img-thumbnail'></div>";
		}
		imagetext += "<div class='item peopleCarouselImg'><img src='" + data['image'] + "' alt='' id='image" + (i+1) + "' height='50%' class='img-responsive img-thumbnail'></div>";
		$('#imagecarousel').html(imagetext);
		if (String(data['foursqdesc'])== 'null') {
			$('#topreview').text(data['desc']);
		} else {
			$('#topreview').text(data['foursqdesc']);
		}
		$('#type').text(data['typeofplace'] + " - " + data['dist'] + " mins walk - " + Math.round(data['foursqrating']*10) + "%");
		$('#tips').text(data['tips'][0]['text']);
		var k = 1;
		$('#tipname').text(data['tips'][0]['name']);
		$('#right').on("click",function() {
			$('#tipname').text(data['tips'][k]['name']);
			$('#tips').text(data['tips'][k]['text']);
			k = k + 1;
			if (k>=data['tipcount']) {
				k = 0;
			}
		});
		$('#left').on("click",function() {
			k = k - 1;
			if (k<0) {
				k = Number(data['tipcount']);
			}
			$('#tipname').text(data['tips'][k]['name']);
			$('#tips').text(data['tips'][k]['text']);
		});
		$('#map').attr('src',"https://maps.googleapis.com/maps/api/staticmap?center=" + data['postcode'] + "&size=500x400&zoom=16&markers=color:red|" + data['postcode'] + "&sensor=false&key=AIzaSyAaKsyipdH7qWdbo8n7ZkdbUzqwdZatus4");
	});
});
});