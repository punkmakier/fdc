<?php 

session_start();
require_once("config.php");
class AuthModel extends config{


    public function login($email, $password)
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->execute([$email, md5($password)]);
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $_SESSION['name'] = $row['name'];
            $_SESSION['uid'] = $row['id'];
            return true; 

        }
        return false; 
    }


    public function register($name,$password,$email)
    {
        if(!$this->checkEmailExist($email)){
             $connection = $this->openConnection();
            $stmt = $connection->prepare("INSERT INTO users (email, password, name) VALUES(?,?,?)");
            $stmt->execute([$email, md5($password),$name]);
            if($stmt->rowCount() > 0){
                return "Success"; 
            }
            return false; 
        }else{
            return "Email exist";
        }

       
    }

    public function checkEmailExist($email)
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            return true; //exist
        } 
        return false; 
    }


}



?>