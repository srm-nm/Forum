<?php
require_once '../Constant/DB_Const.php';

class Post {
    
    private $db;
    
    public function __construct($dsn, $user, $pass) {
        
        try {
            $this->db = new PDO($dsn, $user, $pass);
        } catch(PDOException $e) {
            echo DB_Const::SQL_CONN_ERR;
        }
        
    }
    
    /**
     * 全項目入力された場合の投稿する処理
     */
    public function newPost($thread_id, $post_name, $post_text, $datetime) {
        
        try {
            
            $query = $this->db->prepare(DB_Const::INS_POST);
            $query->bindValue(1, $thread_id);
            $query->bindValue(2, $post_name);
            $query->bindvalue(3, $post_text);
            $query->bindValue(4, $datetime);
            $query->execute();
            
        } catch(Exception $e) {
            print_r($e->getMessage());
        }
        
    }
    
    /**
     * 名前以外入力された場合の投稿の処理
     */
    public function newNamelessPost($thread_id, $post_text, $datetime) {
        
        try {
            
            $query = $this->db->prepare(DB_Const::INS_POST_NN);
            $query->bindValue(1, $thread_id);
            $query->bindvalue(2, $post_text);
            $query->bindValue(3, $datetime);
            $query->execute();
            
        } catch(Exception $e) {
            print_r($e->getMessage());
        }
        
        
    }
    
    /**
     * スレッドに応じた投稿を取得
     */
    public function displayPost($thread_id) {
        
        $stmt = $this->db->query(DB_Const::GET_POST.$thread_id);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    /**
     * 投稿者名をエスケープ処理
     */
    public function viewPostName($post_name) {
        
        $ent_name = htmlspecialchars($post_name, ENT_QUOTES, 'UTF-8');
        return $ent_name;
        
    }
    
    /**
     * 投稿内容をエスケープ処理・改行コードをbrタグに変換
     */
    public function viewPostText($post_text) {
        
        $ent_text = htmlspecialchars($post_text, ENT_QUOTES, 'UTF-8');
        $br_text  = nl2br($ent_text);
        return $br_text;
        
    }
}