<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');

if(isset($_POST['user_name']) || isset($_POST['login_id']) || isset($_POST['login_pass'])) return 0;
    
if(!empty($_POST['user_name']) && !empty($_POST['login_id']) && !empty($_POST['login_pass'])) {
        
        
        
    }

?>

<html>
	<head>
	</head>
	<body>
		<h3>新規登録</h3>
		<form action="" method="POST">
			<div>
				<label>ユーザー名</label>
				<input type="text" name="user_name">
			</div>
			<div>
				<label>ユーザーID</label>
				<input type="text" name="login_id">
			</div>
			<div>
				<label>パスワード</label>
				<input type="text" name="login_pass">
			</div>
			<input type="submit" value="登録">
		</form>
	</body>
</html>