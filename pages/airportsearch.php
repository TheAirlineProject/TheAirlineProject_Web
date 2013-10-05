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

			.print {margin-top: 5px; border-bottom: 2px solid #ccc;}
		</style>
	</head>
	<body>
<?php
	$con = mysqli_connect('localhost','root','asdf','tap') or die("error connecting");
	$s = $_GET['tsearch'];
	$icao = $_GET['icao'];
	$iata = $_GET['iata'];
	$type = $_GET['type'];
	$town = $_GET['town'];
	$country = $_GET['country'];
	$size = $_GET['size'];
	$pax = $_GET['pax'];
	$cargo = $_GET['cargo'];
	$cvolume = $_GET['cvolume'];
	$ccomp = $_GET['cargocomp'];
	$pcomp = $_GET['pcomp'];

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
		$sql = "SELECT * FROM airports WHERE name LIKE '%" . $s . "%' " ;
	}
	else {
		$sql = "SELECT * FROM airports WHERE name LIKE '%%'";
	}

	if($iata != null) {
		$sql .= "AND iata='$iata'";  
	}

	if($icao != null) {
		$sql .= "AND icao='$icao'";
	}

	if($type != "null") {
		$sql .= "AND type='$type'";
	}

	if($town != null) {
		$sql .= "AND town LIKE '%$town%'";
	}

	if($country != null) {
		$sql .= "AND country='$country'";
	}

	if($size != "null") {
		$sql .= "AND size='$size'";
	}

	if($pax != null) {
		if($pcomp == "more") {
		$sql .= "AND pax>='$pax'";
		}

		else { $sql .= "AND pax<='$pax'"; }
	}

	if($cargo != "null") {
		$sql .= "AND cargo='$cargo'";
	}

	if($cvolume != null) {
		if($ccomp == "more") {
		$sql .= "AND cvolume>='$cvolume'";
		}
		else { $sql .= "AND cvolume>='$cvolume'"; }
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
			<h4>Name:</h4><h5> <?php echo str_replace('fslash','/',$row['name']) ?></h5>

			<h4>IATA:</h4><h5> <?php echo $row['iata'] ?></h5>

			<h4>ICAO:</h4><h5> <?php echo $row['icao'] ?></h5>

			<h4>Town:</h4><h5> <?php echo $row['town'] ?></h5>

			<h4>Country:</h4><h5> <?php echo $row['country'] ?></h5>

			<h4>License:</h4><h5> <?php echo $row['type'] ?></h5>

			<h4>Pax Size Category:</h4><h5> <?php echo $row['size'] ?></h5><br />

			<h4>Pax Per Year:</h4><h5> <?php echo ($row['pax'] * 1000) ?></h5>

			<h4>Cargo Size Category:</h4><h5> <?php echo $row['cargo'] ?></h5>

			<h4>Cargo Volume:</h4><h5> <?php echo ($row['cvolume'] * 1000) ?></h5>
			<br />
			<h4>Terminals:</h4><br /><h6> <?php echo $row['terminals'] ?></h5>
			<br />
			<h4>Runways:</h4><br /><h6> <?php echo "Name: " . $ru ?></h5>


			</div>

		<?php
	}

	mysqli_close($con);
?>

	</body>
</html>