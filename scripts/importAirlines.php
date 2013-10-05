<?php

// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
// 

	$con = mysqli_connect('localhost','root','asdf','tap') or die("error connecting" . mysqli_connect_error());
$dir = "xml/airlines/";
	$files = scandir($dir);
	while($files[0] == "." || $files[0] == "..") {
		array_shift($files);
	}

	$i = 0;



	foreach($files as $f) {
		$xml = simplexml_load_file('xml/airlines/' . $f);
		//echo "xml";var_dump($xml);
		//echo "profile";var_dump($xml->profile);
		//echo "airline";var_dump($xml->airline);
		echo $xml->profile['name'];

		$name = $xml->profile['name'];
		$iata = $xml->profile['iata'];
		$color = $xml->profile['color'];
		$country = $xml->profile['country'];
		$ceo = $xml->profile['CEO'];
		$mentality = $xml->profile['mentality'];
		$market = $xml->profile['market'];
		$airport = $xml->profile['preferedairport'];

		$narrative = $xml->profile->narrative['narrative'];

		$sql = 'INSERT INTO airlines (name, iata, color, country, ceo, mentality, market, airport, narrative) ';
		$sql .= "VALUES(\"$name\",\"$iata\",\"$color\",\"$country\",\"$ceo\",\"$mentality\",\"$market\",\"$airport\",\"$narrative\")";
		//echo $sql . "<br />";

		mysqli_query($con, $sql) or die("error:" . mysqli_error($con));
	}

	mysqli_close($con);

?>