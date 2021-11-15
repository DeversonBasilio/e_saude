<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    if(isset($_SESSION["UBS"]) && isset($_POST["ESP"]) && isset($_POST["Ativo"]) && $_SESSION["USUARIOS"]['PersonID']) {

        $UBS  = $_SESSION["UBS"];
        $User = $_SESSION["USUARIOS"]['PersonID'];
        $Esp_id = $_POST["ESP"];
        $Ativo  = $_POST["Ativo"];

        /// O Ativo veio 0? Então ou não existe esta especialidade nessa UBS ou Esta desativada. INSERT Ubs_Especialidade se não existe, Update se existe
        if($Ativo == 0) {
            $sql = "select id from Ubs_Especialidades where Especialidade_id = ? and Ubs_id = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param('ii',$Esp_id,$UBS);
            $stmt->execute();
            $result = $stmt->get_result();

            $row_cnt = $result->num_rows;

            if($row_cnt > 0) {

                $sql = "update Ubs_Especialidades set Ativo = 1, Pessoa_id_alterou = ? where Ubs_id = ? and Especialidade_id = ? and id > 0";
            
                echo $User. " - ". $UBS . " - ".$Esp_id;
                
                // Prepare the statement.
                $statement = $conn->prepare($sql);
                
                // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
                $statement->bind_param('iii', $User, $UBS, $Esp_id);
                // Execute the statement.

                if($statement->execute()) {
                    echo 'success';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error; 
                }

            } else {
                
                
                $sql = "    insert into Ubs_Especialidades(Ubs_id, Especialidade_id, Ativo, Pessoa_id_criou, Pessoa_id_alterou,data_criacao)
                            values ( ? , ? , 1 , ? , ? , now())  ";
        
                // Prepare the statement.
                $statement = $conn->prepare($sql);
                
                // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
                $statement->bind_param('iiii', $UBS, $Esp_id, $User, $User);
                // Execute the statement.
                
                if($statement->execute()) {
                    echo 'success';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error; 
                }
            }
        }
        else /// Ativo veio 1? Então já existe esta especialidade nessa Ubs e esta sendo desativada: Updade Ubs_Especialidade, Ativo = 0;
        {  
            $sql = "update Ubs_Especialidades set Ativo = 0, Pessoa_id_alterou = ? where Ubs_id = ? and Especialidade_id = ? and id > 0";
            
            echo $User. " - ". $UBS . " - ".$Esp_id;

            // Prepare the statement.
            $statement = $conn->prepare($sql);
            
            // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
            $statement->bind_param('iii', $User, $UBS, $Esp_id);
            // Execute the statement.
            
            if($statement->execute()) {
                echo 'success';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error; 
            }
        }
    }
}
?>