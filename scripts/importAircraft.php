<?php

// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
// 
// 
	$con = mysqli_connect('localhost','root','asdf','tap') or die("error connecting" . mysqli_connect_error());
$dir = "xml/aircraft/";
	$files = scandir($dir);
	while($files[0] == "." || $files[0] == "..") {
		array_shift($files);
	}

	$i = 0;



	foreach($files as $f) {
		$xml = simplexml_load_file('xml/aircraft/' . $f);
		$i = 0;
		foreach($xml->airliner as $a) {
			$i++;
			$manufacturer = $a['manufacturer'];
			$name = $a['name'];
			$price = $a['price'];

			$body = $a->type['body'];
			$rangetype = $a->type['rangetype'];
			$engine = $a->type['engine'];

			$wingspan = $a->specs['wingspan'];
			$length = $a->specs['length'];
			$range = $a->specs['range'];
			$speed = $a->specs['speed'];
			$fuel = $a->specs['fuelcapacity'];
			$consumption = $a->specs['consumption'];
			$runway = $a->specs['runwaylengthrequired'];

			$pax = $a->capacity['passengers'];
			$pilots = $a->capacity['cockpitcrew'];
			$crew = $a->capacity['cabincrew'];
			$classes = $a->capacity['maxclasses'];

			$start = $a->produced['from'];
			$end = $a->produced['to'];
			$rate = $a->produced['rate'];

			$sql = 'INSERT INTO aircraft (manufacturer, name, price, body, rangetype, engine, wingspan, length, arange, speed, fuel, consumption, runway, pax, pilots, crew, classes, start, end, rate) ';
			$sql .= "VALUES(\"$manufacturer\",\"$name\",\"$price\",\"$body\",\"$rangetype\",\"$engine\",\"$wingspan\",\"$length\",\"$range\",\"$speed\",\"$fuel\",\"$consumption\",\"$runway\",\"$pax\",\"$pilots\",\"$crew\",\"$classes\",\"$start\",\"$end\",\"$rate\")";
			//echo $i . ":" . $sql . "<br /><br />";

			mysqli_query($con,$sql) or die("error:" . mysqli_error($con) . "<br />$sql");

		}

		
	}

	mysqli_close($con);

	?>