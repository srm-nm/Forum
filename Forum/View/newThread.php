<link rel="stylesheet" href="css\styleTh.css">
<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');

require_once '../Model/Connect.php';
require_once '../Model/Thread.php';
require_once '../Model/Post.php';
require_once '../Constant/DB_Const.php';

$flag = 0;

if(isset($_POST['title'])) {
    
    if(!empty($_POST['title']) && $_POST['post_name'] == '' && !empty($_POST['post_text'])) {
        //タイトルと本文だけ入力された場合
        
        $title     = $_POST["title"];
        $post_text = $_POST["post_text"];
        
        $datetime = DB_Const::getDateTime();
        
        //スレッドを作成
        $thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
        $thread->createThread($title, $datetime);
        //作成したスレッドIDを取得
        $thread_id = $thread->getThreadId();
        
        //スレッドの最初の投稿を作成
        $post = new Post(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
        $post->newNamelessPost($thread_id, $post_text, $datetime);
        
        header('Location: top.php');
        
    } elseif(!empty($_POST['title']) && !empty($_POST['post_name']) && !empty($_POST['post_text'])) {
        //全項目入力された場合
        
        $title     = $_POST["title"];
        $post_name = $_POST["post_name"];
        $post_text = $_POST["post_text"];
        
        $datetime = DB_Const::getDateTime();
        
        //スレッドを作成
        $thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
        $thread->createThread($title, $datetime);
        //作成したスレッドIDを取得
        $thread_id = $thread->getThreadId();
        
        //スレッドの最初の投稿を作成
        $post = new Post(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
        $post->newPost($thread_id, $post_name, $post_text, $datetime);
        
        header('Location: top.php'); 
        
    } elseif(empty($_POST['title']) || empty($_POST['post_text'])) {
        //必須項目が入力されていない場合
        
        $flag = 1;
        
    }
    
}



?>

<html>
	<head>
	
	</head>
	<body>
		<header>
			<h1 id="head">掲示板</h1>
		</header>
		<h3>スレッドを新規作成</h3>
		<br />
		<div class="form_err">
			<?php if($flag == 1) { echo DB_Const::FORM_ERR; } ?>
		</div>
		<br/>
		
		<form action="" method="post">
			<div>
				<label for="title">タイトル</label>
				<input type="text" name="title">
			</div>
			<div>
				<label for="post_name">おなまえ</label>
				<input type="text" name="post_name">
			</div>
			<div>
				<label for="text">本文</label><br />
				<textarea name="post_text" cols=60 rows=6></textarea>
			</div>
			<br /><input type="submit" value="作成">
		</form>
		<a href="top.php">スレッド一覧へ戻る</a>
	</body>
</html>