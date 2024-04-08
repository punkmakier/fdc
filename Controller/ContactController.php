<?php 
require_once '../Model/ContactModel.php';

$auth = new ContactModel();

if(isset($_POST['action']) && $_POST['action'] === 'add'){

    if($auth->addContact($_POST['uid'],$_POST['name'],$_POST['company'],$_POST['phone'],$_POST['email'])){
        echo "success";
        return;
    }

    echo "Failed";
    return;
    
}

if(isset($_POST['action']) && $_POST['action'] === 'update'){

    if($auth->updateContact($_POST['updt_uid'],$_POST['updt_name'],$_POST['updt_company'],$_POST['updt_phone'],$_POST['updt_email'])){
        echo "success";
        return;
    }

    echo "Failed";
    return;
}

if(isset($_POST['action']) && $_POST['action'] === 'delete'){

    if($auth->deleteContact($_POST['uid'],$_POST['id'])){
        echo "success";
        return;
    }

    echo "Failed";
    return;
}


if(isset($_POST['action']) && $_POST['action'] === 'search'){

    $auth->fetchContacts($_POST['keyword'],$_POST['uid']);
    return;
}
?>