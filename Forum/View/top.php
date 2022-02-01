<link rel="stylesheet" href="css\style.css">
<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');

require_once '../Constant/DB_Const.php';
require_once '../Model/Thread.php';
require_once '../Controller/Page.php';

// if($_GET['page'] == null) {
//     header('Location: ?page=1');
    
// } elseif(isset($_GET['page'])) {
    
    //スレッドの件数を取得し表示件数に当てはめる
    $thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    
    $page = null;
    
    if(!isset($_GET['page'])) {
        
        $page = 1;
        
    } elseif(is_numeric($_GET['page'])) {
        
        $page = $_GET['page'];
        
    } else {
        
        header('Location: ?');
        
    }
     
    $pagenate = new Page($page);
    
    $searchKey = null;
    $pagenation = $pagenate->pagenate($searchKey);
    
    if(isset($_GET['search'])) {
    
        $searchKey = $_GET["search"];
        $searched_thd = $pagenate->pagenate($searchKey);
    }
    
    
    
    
// }

?>


<html>
	<head>
		<title>掲示板</title>
	</head>
	<body>
		<header>
			<h1>掲示板</h1>
			
		</header>
		<form action="" method="get" name="search" id="search">
    			<label for="search">スレッドを検索</label>
    			<input type="text" name="search">
    			<input type="submit" value="検索">
			</form>
		
		<?php if(isset($_GET['search'])){ ?>
			<table>
    			<tr>
    				<th>　</th>
    				<th>更新日時</th>
    				<th>作成日時</th>
    			</tr>
    			<?php foreach($searched_thd as $col) { ?>
        				<tr>
        					<td id="title"><a href="thread.php?id=<?= $col['id'] ?>"><?= $thread->viewTitle($col['title']) ?></a></td>
        					<td id="date"><?= $col['updated_at'] ?></td>
        					<td id="date"><?= $col['created_at'] ?></td>
        				</tr>
    			<?php } ?> 
			</table>
			<?= $pagenate->searchNextPrev($searchKey); ?>
		<?php } elseif(empty($_GET['search'])) { ?>
			<table>
			<tr>
    				<th>　</th>
    				<th>更新日時</th>
    				<th>作成日時</th>
    		</tr>
			<?php foreach($pagenation as $col) { ?>
    				<tr>
    					<td id="title"><li><a href="thread.php?id=<?= $col['id'] ?>"><?= $thread->viewTitle($col['title']) ?></a></li></td>
    					<td id="date"><?= $col['updated_at'] ?></td>
    					<td id="date"><?= $col['created_at'] ?></td>
    				</tr>
			<?php } ?> 
			</table>
			<br />
			<div class="page">
    			<?= $pagenate->prevPage(); ?>
    			<?= $pagenate->paging(); ?>
    			<?= $pagenate->nextPage(); ?>
			</div>
		<?php } ?>
		<br /><br />
		<a href="newThread.php">新しいスレッドを作成する</a>
	</body>
</html>