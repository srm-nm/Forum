<?php
require_once '../Model/Thread.php';
require_once '../Constant/DB_Const.php';

class Page {
    
    private $thread;
    
    private $count;         //スレッドの総件数
    private $perPage;       //1ページ当たりの表示件数
    private $totalPage;     //最大ページ数
    private $page;          //現在のページ番号
    
    private $prev;          //前のページ番号
    private $next;          //次のページ番号
    
    public function __construct($page) {
        
        $this->thread = new Thread(DB_Const::DSN, DB_Const::USER, DB_Const::PASS);
        
        $this->count     = $this->thread->countThreadList();
        $this->perPage   = 10;
        $this->totalPage = ceil($this->count / $this->perPage);
        $this->page      = $page;
        
        $this->prev = max($this->page - 1, 1);
        $this->next = min($this->page + 1, $this->totalPage);
        
    }
    
    /**
     * 定めた件数表示のページネーション処理
     */
    public function pagenate ($searchKey) {
        
        if(isset($searchKey)) {
            $stmt = $this->thread->searchThread();
            
            if($this->page == 1) {
                //１ページ目の場合
                $stmt->bindValue(1, '%'.$searchKey.'%');
                $stmt->bindValue(2, $this->page - 1, PDO::PARAM_INT);
                $stmt->bindValue(3, $this->perPage, PDO::PARAM_INT);
                
                
            } else {
                //１ページ以外の場合
                $stmt->bindValue(1, '%'.$searchKey.'%');
                $stmt->bindValue(2, ($this->page - 1) * $this->perPage, PDO::PARAM_INT);
                $stmt->bindValue(3, $this->perPage, PDO::PARAM_INT);
                
            }
            
        } else {
            $stmt = $this->thread->getThdLimDesc();
            
            if($this->page == 1) {
                //１ページ目の場合
                $stmt->bindValue(1, $this->page - 1, PDO::PARAM_INT);
                $stmt->bindValue(2, $this->perPage, PDO::PARAM_INT);
                
            } else {
                //１ページ以外の場合
                $stmt->bindValue(1, ($this->page - 1) * $this->perPage, PDO::PARAM_INT);
                $stmt->bindValue(2, $this->perPage, PDO::PARAM_INT);
                
            }
        }
        
        
        
        $stmt->execute();
        $select = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $select;
        
    }
    
    /**
     * ページング
     */
    public function prevPage() {
        
        if($this->page != 1) {
            print '<a href="?page=1"><<</a>'.'　';
            print '<a href="?page='. $this->prev .'"><</a>'.'　';
        }
        
    }
    
    public function nextPage() {
        
        if($this->page < $this->totalPage) {
            print '<a href="?page='. $this->next .'">></a>'.'　';
            print '<a href="?page='. $this->totalPage . '">>></a>';
        }
        
    }
    
    /**
     * 検索後のページング
     */
    public function searchNextPrev($searchKey) {
        
        if($this->page != 1) {
            print '<a href="?search='. $searchKey .'?page='. $this->prev .'"><</a>'.'　';
            print '<a href="?search='. $searchKey .'?page='. $this->prev .'"><</a>'.'　';
        }
        if($this->page < $this->totalPage) {
            print '<a href="?search='. $searchKey .'?page='. $this->next .'">></a>'.'　';
            print '<a href="?search='. $searchKey .'?page='. $this->totalPage . '">>></a>';
        }
        
    }
    
    public function paging() {
        
        for($i = 1; $i <= $this->totalPage; $i++) {
            if($i == $this->page) {
                print $this->page.'　';
            } else {
                print '<a class="paging" href="?page='. $i .'">'. $i .'</a>'.'　';
            }
        }
        
    }
    
}