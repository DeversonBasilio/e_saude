<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    if(isset($_POST["UBS_ID"]) && isset($_SESSION["USUARIOS"]["PersonID"])) {
        
        $CNES = $_POST["CNES"];
        $NOME = $_POST["NOME"];
        $TEL  = $_POST["TEL"];
        $CEP  = $_POST["CEP"];   
        $Rua  = $_POST["Rua"];   
        $NUM  = $_POST["NUM"];   
        $Bairro  = $_POST["Bairro"];
        $Cidade  = $_POST["Cidade"];
        $UBS_ID  = $_POST["UBS_ID"];
        
        $sql = "Update  Ubs
                Set	    cod_cnes	    = ?,
                        nom_estab       = ?,
                        dsc_telefone    = ?,

                        CEP             = ?,
                        dsc_endereco    = ?,
                        end_num         = ?,

                        dsc_bairro      = ?,
                        dsc_cidade      = ?
            Where       Id              = ?";
        
        // Prepare the statement.
        $statement = $conn->prepare($sql);
        
        // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
        $statement->bind_param('ssssssssi',  $CNES, $NOME, $TEL , $CEP ,$Rua, $NUM , $Bairro, $Cidade, $UBS_ID);
        // Execute the statement.
        $statement->execute();

        if($conn->affected_rows == 1) {
            echo 'success';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
}
?>