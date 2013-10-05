<?php

// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
// 
$dir = "xml/airports/";
	$files = scandir($dir);
	while($files[0] == "." || $files[0] == "..") {
		array_shift($files);
	}

	$i = 0;

?><select><?php
		$xml = simplexml_load_file('xml/airports/super.xml');
		foreach($xml->airport as $a) {
			$i++;
			$name = $a['name'];
			echo "<option value=\"xml/airports/super.xml\" data-pos=\"$i\" data-airport=\"$name\">" . $name . "</option>";
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
	<h3>IATA:</h3><p id="iata"></p>
	<h3>ICAO:</h3><p id="icao"></p>
	<h3>City:</h3><p id="town"></p>
</div>
<div style="width: 25%; display: inline-block; margin-left: 2%;">
	<h3>Annual Pax:</h3><p id="pax"></p>
	<h3>Runways/Longest: </h3><p class="length" id="runway"></p>
	<h3>Terminals/Gates: </h3><p id="gates"></p>
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
		var a = opt.attr('data-airport');
		var f = opt.val();
		console.log(f + ":", a + ":", p);

		$.get('./' + f, function(d) {
			f = $($(d).find('airport')[p-1]);
			//getting the basic data
			var icao = f.attr('icao'); $('#icao').text(icao);
			var iata = f.attr('iata'); $('#iata').text(iata);
			var name = f.attr('name'); $('#name').text(name);


			//setup for getting number of gates
			var term = f.find('terminals')[0]; 
			term = $(term);
			var l = term.find('terminal').length;

			var gs = 0;
			//lets get the total # of gates
			for(var i = 0; i <= term.find('terminal').length; i++) {
				if(i == term.find('terminal').length) {
					$('#gates').text(l + " / " + gs);
				}

				console.log(gs);
				var gst = parseInt($(term.find('terminal')[i]).attr('gates'));
				gs += gst;
			}

			//how many runways are there?
			var rwys = f.find('runways')[0];
			rwys = $(rwys).find('runway');

			var length = [];
			for(q=0;q < $(rwys).length;q++) {
				var t = ($(rwys[q]).attr('length'));
				length.push(t);
			}

			//the longest runway - #rwys is q
			if($('.unit').val() == "meters") {
			$('#runway').text(rwys.length + " / " + Math.max.apply(Math,length) + " meters");
			}

			else {
				var feet = addCommas(Math.max.apply(Math, length) * 3.28);
				$('#runway').text(rwys.length + " / " + feet + " feet");
			}

			//what town is it in?
			var town = $(f.find('town')[0]);
			town = town.attr('town');
			$('#town').text(town);

			//annual pax traffic?
			var pax = $(f.find('size')[0]);
			pax = pax.attr('pax');
			$('#pax').text(addCommas(pax * 1000));
		})
	})
})
</script>

</body>
</html>
