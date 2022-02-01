<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');

if(!isset($_POST['user_name'])) {
    
    
    
} else {
    
    if($_POST['user_name'] && $_POST['pass']) {
        
        
        
    }
        
}


?>

<html>
	<head>
		<title>ログイン</title>
	</head>
	<body>
		<h3>ユーザーログイン</h3>
		<form action="" method="post">
			<div>
				<input type="text" name="user_name">
			</div>
			<div>
				<input type="text" name="pass">
			</div>
			<input type="submit" value="ログイン">
		</form>
	</body>
</html>