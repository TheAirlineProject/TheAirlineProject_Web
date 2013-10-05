<!DOCTYPE html>
<html>
	<head>
		<title>Search Results</title>
		<style type="text/css">
			* {font-size: 16px; margin: 0; padding: 0;}
			h4 {display:block} 
			h5 {
				display: inline-block;
				font-family: Arial, sans-serif;
			}

			h4 {
				margin: 1% 0 0 1%;
				font-size: 1.3em;
				font-style: italic;
				
			}
			h5 {
				margin-left: 2%;
				font-size: 1.1em;
				font-weight: 200;
			}
			h6 {
				margin-left: 2%;
				font-size: 1em;
			}

			p {margin-left: 2%;}

				body {
background: #7db9e8; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  #7db9e8 0%, #1e5799 76%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#7db9e8), color-stop(76%,#1e5799)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  #7db9e8 0%,#1e5799 76%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  #7db9e8 0%,#1e5799 76%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  #7db9e8 0%,#1e5799 76%); /* IE10+ */
background: radial-gradient(ellipse at center,  #7db9e8 0%,#1e5799 76%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7db9e8', endColorstr='#1e5799',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

	}

	* {
		color: white;
	}

			.print {margin-top: 5px; border-bottom: 2px solid #ccc;}
		</style>
	</head>
	<body>
<?php
	$con = mysqli_connect('localhost','root','asdf','tap') or die("error connecting");
	$s = $_POST['tsearch'];
	$manufacturer = $_POST['manufacturer'];
	$price = $_POST['icao'];
	$body = $_POST['body'];
	$rangetype = $_POST['rangetype'];
	$engine = $_POST['engine'];
	$wingspan = $_POST['wingspan'];
	$length = $_POST['length'];
	$range = $_POST['range'];
	$speed = $_POST['speed'];
	$fuel = $_POST['fuel'];
	$consumption = $_POST['consumption'];
	$runway = $_POST['runway'];
	$pax = $_POST['pax'];
	$crew = $_POST['crew'];
	$pilots = $_POST['pilots'];
	$year = $_POST['year'];

	$pcomp = $_POST['pcomp'];
	$wingcomp = $_POST['wingcomp'];
	$lengthcomp = $_POST['lenghcomp'];
	$rcomp = $_POST['rcomp'];
	$speedcomp = $_POST['speedcomp'];
	$fuelcomp = $_POST['fuelcomp'];
	$conscomp = $_POST['conscomp'];
	$rwcomp = $_POST['rwcomp'];
	$paxcomp = $_POST['paxcomp'];
	$crewcomp = $_POST['crewcomp'];

	function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}



		?>
			<h1>The Airline Project</h1>
			<h2>Results for:<?php echo $s ?></h2>
		<?php
	$sql;
	if($s != null) {
		$sql = "SELECT * FROM aircraft WHERE name LIKE '%" . $s . "%' " ;
	}
	else {
		$sql = "SELECT * FROM aircraft WHERE name LIKE '%%'";
	}

	if($manufacturer != "null") {
		$sql .= "AND manufacturer='$manufacturer'";
	}

	if($body != "null") {
		$sql .= " AND body='$body'";
	}

	if($rangetype != "null") {
		$sql .= " AND rangetype='$rangetype'";
	}

	if($engine != "null") {
		$sql .= " AND engine='$engine'";
	}

	if($price != null) {
		if($pcomp == "more") {
			$sql .= "AND price>='$price'";
		}

		else { $sql .= "AND price<='$price'"; }
	}

	if($wingspan != null) {
		if($wingcomp == "more") {
			$sql .= " AND wingspan>='$wingspan'";
		}

		else { $sql .= "AND wingspan<='$wingspan'"; }
	}

	if($length != null) {
		if($lengthcomp == "more") {
			$sql .= " AND length>='$length'";
		}

		else { $sql .= "AND length<='$length'"; }
	}

	if($range != null) {
		if($rcomp == "more") {
			$sql .= " AND arange>='$range'";
		}

		else { $sql .= "AND arange<='$range'"; }
	}

	if($speed != null) {
		if($speedcomp == "more") {
			$sql .= " AND speed>='$speed'";
		}

		else { $sql .= "AND speed<='$speed'"; }
	}

	if($fuel != null) {
		if($fuelcomp == "more") {
			$sql .= " AND fuel>='$fuel'";
		}

		else { $sql .= "AND fuel<='$fuel'"; }
	}

	if($consumption != null) {
		if($conscomp == "more") {
			$sql .= " AND consumption>='$consumption'";
		}

		else { $sql .= "AND consumption<='$consumption'"; }
	}

	if($runway != null) {
		if($rwcomp == "more") {
			$sql .= " AND runway>='$runway'";
		}

		else { $sql .= "AND runway<='$runway'"; }
	}

	if($pax != null) {
		if($paxcomp == "more") {
			$sql .= " AND pax>='$pax'";
		}

		else { $sql .= "AND pax<='$pax'"; }
	}

	if($crew != null) {
		if($crewcomp == "more") {
			$sql .= " AND crew>='$crew'";
		}

		else { $sql .= "AND wingspan<='$crew'"; }
	}

	if($pilots != "null") {
		$sql .= " AND pilots=$pilots'";
	}

	if($year != null) {
		$sql .= " AND end>='$year' AND start<='$year'";
	}

	echo $sql;
	$res = mysqli_query($con, $sql) or die("query error");
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		foreach($row as &$r) {str_replace('flash','/',$r);}
			$ru = $row['runways'];
			$ru = str_replace('fslash','/',$ru);
			$ru = str_replace('-','/',$ru);
			$ru = str_replace('...', '<br />Name: ', $ru);
			$ru = str_replace('..',' Surface: ', $ru);
			$ru = str_replace('.',' Length (m): ', $ru);		
			$ru = str_lreplace('Name:','',$ru);


			$row['terminals'] = str_replace('..','<br />',$row['terminals']);
			$row['terminals'] = str_replace('.',' Gates: ',$row['terminals']);
		?>
			<div class="print">
	
			<h4>Manufacturer:</h4><h5> <?php echo $row['manufacturer'] ?></h5>
			<h4>Name:</h4><h5> <?php echo $row['name'] ?></h5>
			<h4>Price:</h4><h5 class="commas"> <?php echo $row['price'] ?></h5>
			<h4>Body Type:</h4><h5> <?php echo $row['body'] ?></h5>
			<h4>Range Type:</h4><h5> <?php echo $row['rangetype'] ?></h5>
			<h4>Engine Type:</h4><h5> <?php echo $row['engine'] ?></h5><br />
			<h4>Wingspan:</h4><h5> <?php echo ($row['wingspan'] ) ?></h5>
			<h4>Length:</h4><h5> <?php echo $row['length'] ?></h5>
			<h4>Range (km):</h4><h5 class="commas"> <?php echo $row['arange'] ?></h5>
			<h4>Speed (km/h):</h4><h5> <?php echo $row['speed'] ?></h5>
			<h4>Fuel Capacity (l):</h4><h5 class="commas"> <?php echo $row['fuel'] ?></h5>
			<h4>Fuel Consumption (l/pax/km):</h4><h5> <?php echo $row['consumption'] ?></h5>
			<h4>Minimum Runway Length:</h4><h5 class="commas"> <?php echo $row['runway'] ?></h5>
			<h4>Passenger Capacity:</h4><h5> <?php echo $row['pax'] ?></h5>
			<h4>Pilots:</h4><h5> <?php echo $row['pilots'] ?></h5>
			<h4>Cabin Crew:</h4><h5> <?php echo $row['crew'] ?></h5>
			<h4>Max Classes:</h4><h5> <?php echo $row['classes'] ?></h5>
			<h4>Production Start:</h4><h5> <?php echo $row['start'] ?></h5>
			<h4>Production End:</h4><h5> <?php echo $row['end'] ?></h5>

			</div>

		<?php
	}

	mysqli_close($con);
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
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

	$('.commas').each(function() {
		$(this).text(addCommas($(this).text()));
	})
</script>

	</body>
</html>