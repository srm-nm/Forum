<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');




?>

<html>
	<head>
		<title></title>
	</head>
	<body>
		<form action="validate.php" method="POST">
			<div>
				<label>a</label>
				<input type="text" name="a">
			</div>
			<div>
				<label>b</label>
				<input type="text" name="b">
			</div>
			<div>
				<label>c</label>
				<input type="text" name="c">
			</div>
			<br />
			<input type="submit" value="送信">
		</form>
	</body>
</html>