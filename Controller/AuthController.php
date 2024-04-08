<?php 
require_once '../Model/AuthModel.php';

$auth = new AuthModel();

if(isset($_POST['action']) && $_POST['action'] === 'login'){

    if($auth->login($_POST['email'],$_POST['password'])){
        echo "success";
        return;
    }

    echo "Failed";
    return;
    
}

if(isset($_POST['action']) && $_POST['action'] === 'register'){
   echo $auth->register($_POST['fname'],$_POST['password'],$_POST['email']);
}

?>