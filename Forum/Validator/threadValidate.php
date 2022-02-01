<?php
require_once '../Model/Thread.php';
require_once '../Model/Post.php';
require_once '../Constant/DB_Const.php';


if($_POST['title'] == !'' && $_POST['post_name'] == !'' && $_POST['post_name'] == !'') {
    //全項目入力された場合
    
    $title     = $_POST["title"];
    $post_name = $_POST["post_name"];
    $post_text = $_POST["post_text"];
    
    $datetime = DB_Const::getDateTime();
    
    //入力情報をエンティティ化
    $title     = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $post_name = htmlspecialchars($post_name, ENT_QUOTES, 'UTF-8');
    $post_text = htmlspecialchars($post_text, ENT_QUOTES, 'UTF-8');
    
    //改行コードをbrタグに変換
    $post_text_br = nl2br($post_text);
    
    //スレッドを作成
    $thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    $thread->createThread($title, $datetime);
    //作成したスレッドIDを取得
    $thread_id = $thread->getThreadId();
    
    //スレッドの最初の投稿を作成
    $post = new Post(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    $post->newPost($thread_id, $post_name, $post_text_br, $datetime);
    
    header('Location: ../View/top.php');
    
} elseif($_POST['title'] == !'' && $_POST['post_name'] == !'') {
    //タイトルと本文だけ入力された場合
    
    $title     = $_POST["title"];
    $post_text = $_POST["post_text"];
    
    $datetime = DB_Const::getDateTime();
    
    //入力情報をエンティティ化
    $title     = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $post_text = htmlspecialchars($post_text, ENT_QUOTES, 'UTF-8');
    
    //改行コードをbrタグに変換
    $post_text_br = nl2br($post_text);
    
    //スレッドを作成
    $thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    $thread->createThread($title, $datetime);
    //作成したスレッドIDを取得
    $thread_id = $thread->getThreadId();
    
    //スレッドの最初の投稿を作成
    $post = new Post(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
    $post->newNamelessPost($thread_id, $post_text_br, $datetime);
    
    header('Location: ../View/top.php');
    
} elseif(empty($_POST['title']) && empty($_POST['post_name']) && empty($_POST['post_text'])) {
    //何も入力されていない場合
    
    header('location: ../View/newThread.php');
    
} elseif(empty($_POST['title']) || empty($_POST['post_text'])) {
    //必須項目が入力されていない場合
    
    header('location: ../View/newThread.php');
    
}