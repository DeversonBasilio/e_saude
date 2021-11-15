<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

function make_password($password) {
    return password_hash($password, PASSWORD_ARGON2I);
}

if (CONEXAO == 'yes') 
{
    if(isset($_POST["pach"]) && isset($_POST["email_01"]) && isset($_POST["uid"])) {
            
        $pach   = $_POST["pach"];
        $uid    = $_POST["uid"];
        $email  = $_POST["email_01"];
               
        $sql = "update Usuario set senha = '".make_password($pach)."' where id = ".$uid." and email = '".$email."' ";
        
        // Prepare the statement.
        $statement = $conn->prepare($sql);
        
        // Execute the statement.
        $statement->execute();

        if($conn->affected_rows == 1) {
            echo 'sucesso';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
}   ?>