<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

function make_password($password) {
    return password_hash($password, PASSWORD_ARGON2I);
}

if (CONEXAO == 'yes') 
{   
    if(isset($_POST["Email_entrar"]))
    {
        $VALIDO = false;
        $sql = "    select	Nome, Email, senha, p.id as PersonID, usuario_tipo
                    from		Pessoa	p
                    inner join	Usuario u on p.Id = u.Pessoa_Id
                    where u.email = ? ";
        
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$_POST["Email_entrar"]);
        $stmt->execute();
        $result = $stmt->get_result();
                    
        foreach ($result as $row) { 
            
            $data = array();
            $data['PersonID']   = $row["PersonID"];
            $data['email']      = $row["Email"];
            $data['Nome']       = $row["Nome"];
            $data['usuario_tipo']   = $row["usuario_tipo"];
            $data['valido']         = true;
            
            if($data['valido']) {
                $_SESSION['USUARIOS'] = $data;
                $_SESSION["UBS"]  = $row["usuario_tipo"] == 5 ? 0 : -1;
                $VALIDO = true;
            }
        }

        if($VALIDO)
            echo 'sucesso';  
        else {
            echo 'error';  
        }
    }


    if( isset($_POST["email_01"]) && isset($_POST["password"]) && isset($_POST["nome_comp"]))
    {
        $VALIDO = false;
        $sql = "    select	Nome, Email, senha, p.id as PersonID, usuario_tipo
                    from		Pessoa	p
                    inner join	Usuario u on p.Id = u.Pessoa_Id
                    where u.email = ? ";
        
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$_POST["email_01"]);
        $stmt->execute();
        $result = $stmt->get_result();
                    
        $row_cnt = mysqli_num_rows($result);

        if($row_cnt == 0) {

            $nome_comp = $_POST["nome_comp"];
            $email_01  = $_POST["email_01"];
            $password  = $_POST["password"];

            mysqli_autocommit($conn, FALSE);
            $sql = "INSERT INTO Pessoa (Nome) values ( '".$nome_comp."' )";

            if (mysqli_query($conn, $sql ) === TRUE) {
                $pessoaID = mysqli_insert_id($conn);
                $sql1 = "INSERT INTO Usuario ( email, senha, pessoa_id, usuario_tipo) value ('".$email_01."' , '".make_password($password)."' , ".$pessoaID." , 5)";
                mysqli_query($conn, $sql1 );
            }  

            if (!mysqli_commit($conn)) {
                $VALIDO = false;
            } else {
                $VALIDO = true;        
            }
        } else {
            $VALIDO = false;
        }

        if($VALIDO)
            echo 'sucesso';  
        else {
            echo 'error';  
        }
    }
}