<?php

// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
// 
$dir = "/var/www/html/tap/xml/";
	$files = scandir($dir);
	while($files[0] == "." || $files[0] == "..") {
		array_shift($files);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>The Airline Project - Airlines</title>
	<link rel="styleheet" href="main.css"/>
</head>
<body>
	<h1>The Airline Project</h1>
	<h2>Airlines Directory</h2>
	<select class="select2">
	<?php
	foreach($files as $f) {
		$name = substr($f, 0, strpos($f, '.'));
		echo "<option value=\"$f\">" . $name . "</option>";
	}

	?>

	</select>
<br />
<div style="width: 25%; display: inline-block;">
	<h3>Name:</h3><p id="name"></p>
	<h3>IATA:</h3><p id="iata"></p>
	<h3>Airport:</h3><p id="airport"></p>
	<h3>CEO:</h3><p id="ceo"></p>
</div>
<div style="width: 25%; display: inline-block; margin-left: 2%;">
	<h3>Target Market:</h3><p id="market"></p>
	<h3>Founded: </h3><p id="founded"></p>
	<h3>Folded: </h3><p id="folded"></p>
	<h3>Info:</h3><p id="info"></p>
</div>
<a href="#" id="dl">Download XML</a>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/select2-3.4.3/select2.js"></script>
<script type="text/javascript">
//uses a select box to input content from file into a text area 
$(document).ready(function() {
var sel = $('select');
$('.select2').select2();
	sel.change(function() {
		$.get('./xml/' + $(this).val(), function(d) {
			var name = $(d).find("profile").attr("name");
			var iata = $(d).find("profile").attr("iata");
			var ap = $(d).find("profile").attr("preferedairport");
			var ceo = $(d).find("profile").attr("CEO");
			var target = $(d).find("profile").attr("market");
			var founded = $(d).find("info").attr("from");
			var folded = $(d).find("info").attr("to");
			var info = $(d).find("narrative").attr("narrative");
			$('#name').text('');
			$('#iata').text('');
			$('#airport').text('');
			$('#ceo').text('');
			$('#info').text('');
			$('#market').text('');
			$('#foudned').text('');
			$('#folded').text('');
			$('#name').text(name);
			$('#iata').text(iata);
			$('#airport').text(ap);
			$('#ceo').text(ceo);
			$('#market').text(target);
			$('#founded').text(founded);
		if(parseInt(folded) > 2015 || parseInt(folded) == '' ) { $('#folded').text('N/A');}
		else {
			$('#folded').text(folded);
		}
			$('#info').text(info);
			$('a').attr('href','xml/' + $(this).val());
			$('a').attr('download', $(this).val());
		})
	})
})
</script>

</body>
</html>
