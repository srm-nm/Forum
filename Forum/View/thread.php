<link rel="stylesheet" href="css\styleTh.css">
<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');

require_once '../Constant/DB_Const.php';
require_once '../Model/Thread.php';
require_once '../Model/Post.php';

$datetime = DB_Const::getDateTime();

$flag = 0;

if(isset($_GET['id'])) {
    
    if(is_numeric($_GET['id'])) {
    //数値を取得した場合、数値に対応したidの画面を表示
        
        $thread_id = $_GET['id'];
    
    $thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    $title = $thread->getThreadTitle($thread_id);
    
    //開かれたスレッドの投稿を取得して表にする
    $post = new Post(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    $post_list = $post->displayPost($thread_id);
        
    } else {
      //数値以外を取得した場合、トップ画面に遷移する
        
        header('Location: top.php');
        
    }
    
} 

if(!isset($_POST['post_text'])) {
    
    $flag = 0;
    
} else {
    
    if($_POST['post_name'] == '' && !empty($_POST['post_text'])) {
    //名前だけ未入力の場合
    
        $post_name = $_POST["post_name"];
        $post_text = $_POST["post_text"];
        
        $thread_id = $_GET['id'];
        
        //入力情報を登録
        $post->newNamelessPost($thread_id, $post_text, $datetime);
        
        $thread->updateTime($datetime, $thread_id);
        header('Location: thread.php?id='.$thread_id);
    
    } elseif(isset($_POST['post_name']) && isset($_POST['post_text'])) {
    //全て入力された場合
    
        $post_name = $_POST["post_name"];
        $post_text = $_POST["post_text"];
        
        $thread_id = $_GET['id'];
        
        //入力情報を登録
        $post->newPost($thread_id, $post_name, $post_text, $datetime);
        
        header('Location: thread.php?id='.$thread_id);
    
    } elseif (empty($_POST['post_text'])) {
    //本文が未入力の場合
    
        $flag = 1;
        
    }
    
}

?>

<html>
	<head>
		<title></title>
	</head>
	<body>
		<header>
			<h1 id="head">掲示板</h1>
		</header>
		<h1><?= $thread->threadTitle($title['title']) ?></h1>
		<ol>
		<?php foreach($post_list as $col) { ?>
			<table>
				<tr>
					<td class="post_name"><li><?= $post->viewPostName($col['post_name']) ?></li></td>
					<td class="date"><?= $col['created_at'] ?></td>
				</tr>
				<tr>
					<td colspan=2; class="text"><?= $post->viewPostText($col['post_text']) ?></td>
				</tr>
			</table>
			<?php } ?> 
		</ol>
		<br />
		<?php if($flag == 1) { echo DB_Const::FORM_ERR; } ?>
		<br />
		<form action="" method="post">
			<div>
				<label for="post_name">おなまえ</label>
				<input type="text" name="post_name" placeholder="名無し">
			</div>
			<div>
				<label for="post_text">本文</label><br />
				<textarea name="post_text" cols="60" rows="6"></textarea>
			</div>
			<br />
			<input type="submit" value="投稿">
		</form>
		<br />
		<a href="top.php">スレッド一覧へ戻る</a>
	</body>
</html>