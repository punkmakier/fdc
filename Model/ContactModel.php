<?php 

require_once("config.php");
class ContactModel extends config{


    public function addContact($uid,$name,$company,$phone,$email)
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("INSERT INTO contacts (uid,name,company,phone,email) VALUES(?,?,?,?,?)");
        if($stmt->execute([$uid,$name,$company,$phone,$email]))
        {
            return true; 
        }
        return false; 
    }



    public function updateContact($uid,$name,$company,$phone,$email)
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("UPDATE contacts SET name = ?, company = ?, phone = ?, email = ? WHERE uid = ?");
        if($stmt->execute([$name,$company,$phone,$email,$uid]))
        {
            return true; 
        }
        return false; 
    }


    public function deleteContact($uid,$id)
    {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("DELETE FROM contacts WHERE uid = ? AND id = ?");
        if($stmt->execute([$uid, $id]))
        {
            return true; 
        }
        return false; 
    }





    public function fetchContacts($keyword, $uid)
    {
        $connection = $this->openConnection();
       $stmt = $connection->prepare("SELECT * FROM contacts WHERE (email LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR name LIKE '%$keyword%' OR company LIKE '%$keyword%') AND uid = '$uid'");

        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                $id = $row['id'];
                $uid = $row['uid'];
                $name = $row['name'];
                $company = $row['company'];
                $phone = $row['phone'];
                $email = $row['email'];
                echo '
                <tr>
                    <td style="display: none;">'.$uid.'</td>
                    <td>'.$name.'</td>
                    <td>'.$company.'</td>
                    <td>'.$phone.'</td>
                    <td>'.$email.'</td>
                    <td>
                        <button class="btn btn-warning edit">Edit</button>
                        <button class="btn btn-danger" onclick="deleteContact('.$uid.','.$id.')">Delete</button>
                    </td>
                </tr>
                ';
            }
            

        }
        else{
            echo "<h1>No data</h1>";
        }
    }




}



?>