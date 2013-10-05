<!DOCTYPE html>
<html>
	<head>
		<title>Search Results</title>
		<style type="text/css">
			* {font-size: 16px; margin: 0; padding: 0;}
			h4,h5 {
				display: inline-block;
				font-family: Arial, sans-serif;
			}

			h4 {
				margin-left: 1%;
				font-size: 1.1em;
				font-style: italic;
			}
			h5 {
				margin-left: 5px;
				font-size: 1.2em;
				font-weight: bold;
			}

			p {margin-left: 2%;}

			.airline {margin-top: 5px; border-bottom: 2px solid #ccc;}
		</style>
	</head>
	<body>
<?php
	$con = mysqli_connect('localhost','root','asdf','tap') or die("error connecting");
	$s = $_GET['tsearch'];
	$a = $_GET['airport'];
	$ment = $_GET['mentality'];

		?>
			<h1>The Airline Project</h1>
			<h2>Results for:<?php echo $s ?></h2>
		<?php
	$sql;
	if($s != null) {
		$sql = "SELECT * FROM airlines WHERE name LIKE '%" . $s . "%'" ;
	}
	else {
		$sql = "SELECT * FROM airlines WHERE name LIKE '%%'";
	}

	if($ment != "null") {
		$sql .= "AND mentality='$ment'";  
	}

	if($a != null) {
		$sql .= "AND airport='$a'";
	}

	$res = mysqli_query($con, $sql) or die("query error");
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		?>
			<div class="airline">
			<h4>Name:</h4><h5> <?php echo $row['name'] ?></h5>

			<h4>IATA:</h4><h5> <?php echo $row['iata'] ?></h5>

			<h4>Country:</h4><h5> <?php echo $row['country'] ?></h5>

			<h4>CEO:</h4><h5> <?php echo $row['ceo'] ?></h5>

			<h4>Mentality:</h4><h5> <?php echo $row['mentality'] ?></h5>

			<h4>Market:</h4><h5> <?php echo $row['market'] ?></h5>

			<h4>Preferred Airport:</h4><h5> <?php echo $row['airport'] ?></h5><br />

			<h4>Description:</h4><p> <?php echo $row['narrative'] ?></p>
			</div>

		<?php
	}

	mysqli_close($con);
?>

	</body>
</html>