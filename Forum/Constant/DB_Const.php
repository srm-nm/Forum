<?php

class DB_Const {
    
    //DB接続に関する定数
    const DSN  = "mysql:host=localhost;dbname=Forum;charset=utf8";
    const USER = "root";
    const PASS = "root";
    
    const SQL_CONN_ERR= "SQLへの接続に失敗しました。";
    
    //INSERT
    const INS_THREAD  = "INSERT INTO Thread (title, created_at, updated_at) values (?, ?, ?)";
    const INS_POST    = "INSERT INTO Post (thread_id, post_name, post_text, created_at) values (?, ?, ?, ?)";
    const INS_POST_NN = "INSERT INTO Post (thread_id, post_text, created_at) values (?, ?, ?)";
    const INS_USER    = "INSERT INTO User (user_name, login_id, login_pass, created_at) values (?, ?, ?, ?)";
    
    //UPDATE
    const UPD_THREAD_TIME_A = "UPDATE Thread SET updated_at =";
    const UPD_THREAD_TIME_B = "WHERE thread_id =";
    
    //SELECT
    const GET_TITLE            = "SELECT title FROM Thread WHERE id =";
    const GET_TITLE_SORT_LIM   = "SELECT id, title, created_at, updated_at FROM Thread WHERE title LIKE ? ORDER BY updated_at DESC LIMIT ?, ?";
    const GET_POST             = "SELECT post_name, created_at, post_text FROM Post WHERE thread_id =";
    const GET_THD_UPD_DESC     = "SELECT id, title, created_at, updated_at FROM Thread ORDER BY updated_at DESC;";
    const GET_THD_UPD_DESK_LIM = "SELECT id, title, created_at, updated_at FROM Thread ORDER BY updated_at DESC LIMIT ?, ?";
    const COUNT_THREAD         = "SELECT COUNT(*) as cnt FROM Thread;";
    
    const CHECK_UQ_USER_ID  = "SELECT COUNT(*) as cnt FROM User WHERE user_id = ?";
    
    //エラーメッセージ
    const FORM_ERR = "※入力項目に不備があります";
    
    
    public static function getDateTime() {
        
        date_default_timezone_set('Asia/Tokyo');
        $datetime = date('Y/m/d H:i:s');
        return $datetime;
        
    }
}

 