<?php
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL');
    
class Connect {
    
    private $pdo;
    
    public function __construct($user, $pass) {
        $this->pdo = new Connect($user, $pass);
    }
    
//     private $dsn = "mysql:host=localhost;dbname=Forum;charset=utf8";
//     private $username = "root";
//     private $password = "root";
    
//     try {
//         $pdo = new PDO($dsn, $username, $password);
//         echo "MySQL への接続に成功しました。";
        
//     } catch (PDOException $e) {
//         $isConnect = false;
//         echo "MySQL への接続に失敗しました。<br>(" . $e->getMessage() . ")";
//     }
    
//     // $stmt = $pdo->prepare('SELECT * FROM Thread;');
    
//     // $stmt->execute();
//     // $thread = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//     // unset($pdo);
    
//     // print_r($thread);
//     date_default_timezone_set('Asia/Tokyo');
//     $date = date("Y/m/d H:i:s");
    
//     $stmt = $pdo->prepare("INSERT INTO Thread(title, created_at, updated_at) values('4スレ', '$date', '$date')");
//     $stmt->execute();

    
}

    