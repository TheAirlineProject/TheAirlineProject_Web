<?php

// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
// 
$dir = "xml/aircraft/";
	$files = scandir($dir);
	while($files[0] == "." || $files[0] == "..") {
		array_shift($files);
	}

	$i = 0;

?><select><?php
	foreach($files as $f) {
		$xml = simplexml_load_file('xml/aircraft/' . $f);
		$i = 0;
		echo $xml->airliner['manufacturer'];
		foreach($xml->airliner as $a) {
			$i++;
			$name = $a['name'];
			echo "<option value=\"$dir$f\" data-pos=\"$i\" data-aircraft=\"$name\">" . $name . "</option>";
		}
	}
?></select><?php echo $i; ?>

<!DOCTYPE html>
<html>
<head>
	<title>The Airline Project - Airlines</title>
	<link rel="styleheet" href="main.css"/>
</head>
<body>
	<h1>The Airline Project</h1>
	<h2>Airlines Directory</h2>
	<h3>Select Measurement Units</h3>
	<input class="unit" type="radio" name="units" checked="checked" value="feet">Feet</input>
	<input class="unit" type="radio" name="units" value="meters">Meters</input>
<br />
<div style="width: 25%; display: inline-block;">
	<h3>Name:</h3><p id="name"></p>
	<h3>Price:</h3><p id="price"></p>
	<h3>Engine:</h3><p id="engine"></p>
	<h3>Body Type:</h3><p id="body"></p>
	<h3>Runway Length Required:</h3><p id="runway"></p>
</div>
<div style="width: 25%; display: inline-block; margin-left: 2%;">
	<h3>Capacity:</h3><p id="cap"></p>
	<h3>Range: </h3><p id="range"></p>
	<h3>Cruise Speed: </h3><p id="speed"></p>
	<h3>Produced Began:</h3><p id="begin"></p>
	<h3>Production Ended:</h3><p id="end"></p>
</div>
<a href="#" id="dl">Download XML</a>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/select2-3.4.3/select2.js"></script>
<script type="text/javascript">
//uses a select box to input content from file into a text area 
$(document).ready(function() {

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

var sel = $('select');
	sel.change(function() {
		var opt = sel.find('option:selected');
		var p = opt.attr('data-pos');
		var a = opt.attr('data-aircraft');
		var f = opt.val();

		$.get('./' + f, function(d) {
			f = $($(d).find('airliner')[p-1]);
			//getting the basic data
			var name = f.attr('name'); $('#name').text(name);
			var price = f.attr('price'); $('#price').text("$" + addCommas(price));


			//get the engine and body type
			var type = $(f.find('type')[0]); 
			$('#engine').text(type.attr('engine'));
			$('#body').text(type.attr('body'));

			//get some general performance data
			var specs = $(f.find('specs')[0]);

			//do a little standard/metric conversion if necessary
			$('#speed').text(specs.attr('speed'));
			if($('.unit').val() == "feet") {
			var speed = parseInt(specs.attr('speed')) * 0.62;
			$('#speed').text(speed + " mph");
		}
			$('#range').text(addCommas(specs.attr('range')) + " km");
			if($('.unit').val() == "feet") {
				$('#range').text(addCommas(specs.attr('range') * 0.62) + " miles");
			}


			$('#runway').text(addCommas(specs.attr('runwaylengthrequired')) + " m");

			if($('.unit').val() == "feet") {
				$('#runway').text(addCommas(specs.attr('runwaylengthrequired') * 3.28) + " feet");
			}
			//get the productin dates
			var produced = $(f.find('produced')[0]);
			$('#begin').text(produced.attr('from'));

			if(parseInt(produced.attr('to')) > 2015) {
				$('#end').text('N/A');
			}

			else {
				$('#end').text(produced.attr('to'));
			}

			//get the pax capacity
			var cap = $(f.find('capacity')[0]);
			$('#cap').text(cap.attr('passengers'));
		})
	})
})
</script>

</body>
</html>
