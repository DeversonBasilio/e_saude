<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

function verifica_password($password_forn, $hash_password){
    if (password_verify($password_forn, $hash_password)) {
        return true;
    } else {
        return false;
    }
}

if (CONEXAO == 'yes') 
{
    if( isset($_POST["login"]) && isset($_POST["password"]))
    {
        $VALIDO = false;
        $sql = "    select	Nome, Email, senha, p.id as PersonID, usuario_tipo
                    from		Pessoa	p
                    inner join	Usuario u on p.Id = u.Pessoa_Id
                    where u.email = ? ";
        
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$_POST["login"]);
        $stmt->execute();
        $result = $stmt->get_result();
                    
        foreach ($result as $row) { 
            
            $data = array();
            $data['PersonID']   = $row["PersonID"];
            $data['email']      = $row["Email"];
            $data['Nome']       = $row["Nome"];
            $data['usuario_tipo']   = $row["usuario_tipo"];
            $data['valido']         = verifica_password($_POST["password"],$row["senha"]);
            
            if($data['valido']) {
                $_SESSION['USUARIOS'] = $data;
                $_SESSION["UBS"]  = $row["usuario_tipo"] == 5 ? 0 : -1;
                $VALIDO = true;
            }
        }

        if($VALIDO) {
            echo 'sucesso';  
        }
        else {
            echo 'error';  
        }
    }
}   ?>