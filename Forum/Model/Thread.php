<?php
require_once 'Post.php';
require_once '../Constant/DB_Const.php';

date_default_timezone_set('Asia/Tokyo');


class Thread {
    
    private $db;
    private $id;
    private $thread_id;
    private $thread_title;
    
    //DB接続
    public function __construct($dsn, $user, $pass) {
        try {
            $this->db = new PDO($dsn, $user, $pass);
        } catch(PDOException $e) {
            echo DB_Const::SQL_CONN_ERR;
        }
    }
    
    /**
     * スレッドの件数を取得
     */
    public function countThreadList() {
        
        try {
            
            $stmt = $this->db->query(DB_Const::COUNT_THREAD);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row["cnt"];
            
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
        
    }
    
    /**
     * タイトルをエスケープ処理・指定幅に丸める処理
     */
    public function viewTitle($title) {
        
        $ent_title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $title_view = mb_strimwidth($ent_title, 0, 30, '…', 'UTF-8');
        return $title_view;
        
    }
    
    public function threadTitle($title) {
        
        $ent_title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        return $ent_title;
    }
    
    /**
     * スレッド新規作成
     */
    public function createThread($title, $datetime) {
        
        try {
            $query = $this->db->prepare(DB_Const::INS_THREAD);
            $query->bindValue(1, $title);
            $query->bindValue(2, $datetime);
            $query->bindValue(3, $datetime);
            $query->execute();
            
            $this->thread_id = $this->db->lastInsertId();
//             print_r($this->db->lastInsertId());
            
        } catch (Exception $e) {
            print_r($e->getMessage() );
        }
        
    }
    
    /**
     * スレッドの更新日時を更新
     */
    public function updateTime($datetime, $thread_id) {
        
        try {
            $stmt = $this->db->prepare("UPDATE Forum.Thread SET updated_at = '$datetime' WHERE (id = '$thread_id')");
            $stmt->execute();
            
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
        
    }
    
    //更新が新しい順で取得
    public function getUpdateDesc() {
        
        $stmt = $this->db->query(DB_Const::GET_THD_UPD_DESC);
        $thread_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $thread_list;
        
    }
    
    /**
     * トップ画面に表示するタイトルを取得
     */
    public function topThreadTitle($i) {
        
        try {
            $stmt = $this->db->query(DB_Const::GET_TITLE.$i);
            $title = $stmt->fetch(PDO::FETCH_ASSOC);
            return $title;
            
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 検索フォームに入力された文字列で部分一致するスレッドを取得
     */
    public function searchThread($searchKey) {
        
        try {
            $stmt = $this->db->prepare(DB_Const::GET_TITLE_SORT_LIM);
            return $stmt;
            
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * スレッドページに表示するタイトルを取得
     */
    public function getThreadTitle($thread_id) {
        
        try {
            $stmt = $this->db->query(DB_Const::GET_TITLE.$thread_id);
            $title = $stmt->fetch(PDO::FETCH_ASSOC);
            return $title;
            
        } catch (Exception $e) {
        }
    }
    
    public function getThreadId() {
        return $this->thread_id;
    }
    
    public function getThdLimDesc() {
        
        try {
            
            $stmt = $this->db->prepare(DB_Const::GET_THD_UPD_DESK_LIM);
            return $stmt;
            
        } catch (Exception $e) {
                
        }
    }
    
}