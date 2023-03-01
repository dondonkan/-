<?php



class users {

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


    public function getUserByMail(){
        $stmt = $this->dbConn->prepare('SELECT * FROM login_system WHERE mail = :mail');
        $stmt->bindParam(':mail',$this->mail);
        
        try{
            if($stmt->execute()){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        return $user;
    }

    public function countUp_fail(){
        $sql = 'UPDATE login_system SET fail_count = ? , fail_time = ? WHERE id = ?;';

        $prepare = $this->dbConn->prepare($sql);

        $prepare->bindValue(1, $this->fail_count, PDO::PARAM_INT);
        $prepare->bindValue(2, $this->fail_time, PDO::PARAM_STR);
        $prepare->bindValue(3, $this->id, PDO::PARAM_INT);

        $prepare->execute();
    }

    public function update_time(){
        $sql = 'UPDATE login_system SET fail_count = ? , fail_time = ? WHERE id = ?;';

        $prepare = $this->dbConn->prepare($sql);

        $prepare->bindValue(1, $this->fail_count, PDO::PARAM_INT);
        $prepare->bindValue(2, $this->fail_time, PDO::PARAM_STR);
        $prepare->bindValue(3, $this->id, PDO::PARAM_INT);

        $prepare->execute();
    }

    public function create_user(){
        $sql ='INSERT INTO login_system(mail,password) VALUES ( ? , ? );';

        $prepare = $this->dbConn->prepare($sql);

        $prepare->bindValue(1, $this->mail, PDO::PARAM_STR);
        $prepare->bindValue(2, password_hash($this->password,PASSWORD_DEFAULT), PDO::PARAM_STR);

        $prepare->execute();
    }

    public function update_password(){
        $sql ='UPDATE login_system SET password = ? WHERE mail = ?';

        $prepare = $this->dbConn->prepare($sql);

        $update_pass = password_hash($this->password, PASSWORD_DEFAULT);

        $prepare->bindValue(1, $update_pass, PDO::PARAM_STR);
        $prepare->bindValue(2, $this->mail, PDO::PARAM_STR);


        $prepare->execute();
    }

    public function delete_user(){
        $sql = 'DELETE FROM login_system WHERE mail = ?;';

        $prepare = $this->dbConn->prepare($sql);

        $prepare->bindValue(1, $this->mail, PDO::PARAM_STR);

        $prepare->execute();

        $result =  $prepare->fetch(PDO::FETCH_ASSOC);

        return $result;
    
    }


}