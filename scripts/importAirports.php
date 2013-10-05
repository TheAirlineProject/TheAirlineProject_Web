<?php

$dir = "xml/airports/";
	$files = scandir($dir);
	while($files[0] == "." || $files[0] == "..") {
		array_shift($files);
	}

	$i = 0;


		$con = mysqli_connect("localhost","root","asdf","tap") or die("error connecting");

	$xml = simplexml_load_file('xml/airports/super.xml');
		foreach($xml->airport as $a) {
			$i++;
			$name = $a['name'];
			$icao = $a['icao'];
			$iata = $a['iata'];
			$type = $a['type'];
			$season = $a['season'];

			$town = $a->town['town'];
			$country = $a->town['country'];
			$gmt = $a->town['GMT'];
			$dst = $a->town['DST'];

			$lat = $a->coordinates->latitude['value'];
			$long = $a->coordinates->longitude['value'];

			$size = $a->size['value'];
			$pax = $a->size['pax'];
			$cargo = $a->size['cargo'];
			$cvol = $a->size['cargovolume'];

			$terminals = ""; $runways = "";

			foreach($a->terminals->terminal as $t) {
				$terminals .= $t['name'] . "." . $t['gates'] . "..";
			}

			foreach($a->runways->runway as $r) {
				$runways .= $r['name'] . "." . $r['length'] . "." . $r['surface'] . "..";
			}

			//echo "$name.$icao.$iata.$type.$season.$town.$country.$gmt.$dst.$lat.$long.$size.$pax.$cargo.$cvol.$terminals.$runways.'<br />'";

			$sql1 = "INSERT INTO airports (name, icao, iata, type, season, town, country, gmt, dst, lat, lon, size, pax, cargo, cvolume,terminals,runways) "; 
			$sql2 = "VALUES(\"$name\",\"$icao\",\"$iata\",\"$type\",\"$season\",\"$town\",\"$country\",\"$gmt\",\"$dst\",\"$lat\",\"$long\",\"$size\",$pax,\"$cargo\",\"$cvol\",\"$terminals\",\"$runways\")";
			$sql2 = str_replace('/','fslash',$sql2);
			$sql = $sql1 . $sql2;
		//	$sql = "INSERT INTO airports (name"
		//	echo $sql;
			mysqli_query($con,$sql) or die(' error:' . mysqli_error($con) . "<br />$sql");

			//print_r($ret); //isn't printing anything

			//echo($i . ":" . $name . $icao . $iata . $type . $season . $town . $country . $gmt . $dst . $lat . $long . $size . $pax . $cargo . $cvol . "terminals:" . $terminals . "runways:" . $runways . "<br />");
			

		}

		mysqli_close($con);

		?>