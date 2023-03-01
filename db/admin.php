<?php

class admin {

    private $id;
    private $mail;
    private $password;
    private $auth_type;
    private $fail_count;
    private $fail_time;
    protected $dbConn;

 

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setMail($mail){
        $this->mail = $mail;
    }

    function getmail(){
        return $this->mail;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getPassword(){
        return $this->password;
    }

    function setAuth_type($auth_type){
        $this->auth_type = $auth_type;
    }

    function getAuth_type(){
        return $this->Auth_type;
    }

    function setFail_count($fail_count){
        $this->fail_count = $fail_count;
    }

    function getFail_count(){
        return $this->fail_count;
    }

    function setFail_time($fail_time){
        $this->fail_time = $fail_time;
    }

    function getFail_time(){
        return $this->fail_time;
    }

    public function __construct(){
        require_once('db_access.php');
        $db = new db();

        $this->dbConn = $db->connect();
    }

    public function show_table(){

        $sql='SELECT * FROM login_system WHERE auth_type IS NULL;';

        // PDOStatementクラスのインスタンスを生成します。
        $prepare = $this->dbConn->prepare($sql);

        // プリペアドステートメントを実行する
        $prepare->execute();
        $rows =  $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $rows;

    }

    public function getUserById(){
        $sql = 'SELECT * FROM login_system WHERE id = ?';
        $prepare = $this->dbConn->prepare($sql);

        $prepare->bindValue(1, $this->id, PDO::PARAM_INT);

        // プリペアドステートメントを実行する
        $prepare->execute();
        $rows =  $prepare->fetch(PDO::FETCH_ASSOC);

        return $rows;

    }

    public function update(){
        $sql='UPDATE login_system SET mail = ?, password= ? WHERE id = ?';
        // PDOStatementクラスのインスタンスを生成します。
        $prepare = $this->dbConn->prepare($sql);
    
        $prepare->bindValue(1, $this->mail, PDO::PARAM_STR);
        $prepare->bindValue(2, $this->password, PDO::PARAM_STR);
        $prepare->bindValue(3, $this->id, PDO::PARAM_INT);
    
        // プリペアドステートメントを実行する
        $prepare->execute();
    
    }

    public function delete(){

        $sql='DELETE FROM login_system WHERE id = ?';
        // PDOStatementクラスのインスタンスを生成します。
        $prepare = $this->dbConn->prepare($sql);

        $prepare->bindValue(1, $this->id, PDO::PARAM_INT);

        // プリペアドステートメントを実行する
        $prepare->execute();

    }



}