<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    #### POST DE UPDADE DA PAGINA
    if(isset($_POST["PersonID"])) 
    {

        $CPF = isset($_POST["CPF"]) ? $_POST["CPF"] : "";
        $RG  = isset($_POST["RG"])  ? $_POST["RG"]  : "";
        $CNS = isset($_POST["CNS"]) ? $_POST["CNS"] : "";
        
        $Nome               = isset($_POST["Nome"])             ? $_POST["Nome"]              : "";
        $Data_Nascimento    = isset($_POST["Data_Nascimento"])  ? $_POST["Data_Nascimento"]   : null;

        $Tipo_Sangue        = isset($_POST["Tipo_Sangue"])      ? $_POST["Tipo_Sangue"]      : null;
        $Cor                = isset($_POST["Cor"])              ? $_POST["Cor"]              : null;
        $sexo               = isset($_POST["sexo"])             ? $_POST["sexo"]             : null;
                    
        $celular           = isset($_POST["celular"])     ? $_POST["celular"]     : "";
        $Telefone          = isset($_POST["Telefone"])    ? $_POST["Telefone"]    : "";
        $Telefone_2        = isset($_POST["Telefone_2"])  ? $_POST["Telefone_2"]  : "";
        
        $CEP               = isset($_POST["CEP"])           ? $_POST["CEP"]     : "";
        $Rua               = isset($_POST["Rua"])           ? $_POST["Rua"]     : "";
        $Numero            = isset($_POST["Numero"])        ? $_POST["Numero"]  : "";
        $Bairro            = isset($_POST["Bairro"])        ? $_POST["Bairro"]  : "";
        $Complemento       = isset($_POST["Complemento"])   ? $_POST["Complemento"]  : "";
        $Cidade            = isset($_POST["Cidade"])        ? $_POST["Cidade"]  : "";
        
        $sql = "Update Pessoa
                    Set	CPF		            = ?,
                        RG		            = ?,
                        CNS		            = ?,
                        Nome		        = ?,
                        Data_Nascimento     = ?,
                        Tipo_Sangue         = ?,
                        Cor_Id			    = ?,
                        Sexo_Id			    = ?,
                        celular             = ?,
                        Telefone            = ?,
                        Telefone_2          = ?,
                        CEP                 = ?, 
                        Rua                 = ?, 
                        Numero              = ?, 
                        Bairro              = ?, 
                        Complemento         = ?, 
                        Cidade              = ?, 
                        UF                  = ?, 
                        Pais                = ?
                    Where Id = ?";
            
            // Prepare the statement.
            $statement = $conn->prepare($sql);
            
            // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
            $statement->bind_param('ssssssiisssssssssiii',  
                                    $CPF          ,$RG      ,$CNS       ,$Nome      ,$Data_Nascimento, 
                                    $Tipo_Sangue  ,$Cor     ,$sexo      ,$celular   ,$Telefone, 
                                    $Telefone_2   ,$CEP     ,$Rua       ,$Numero    ,$Bairro,
                                    $Complemento  ,$Cidade  ,$UF        ,$Pais      ,$_POST["PersonID"]);
            // Execute the statement.
            $statement->execute();

            echo 'sucesso';
    }
}
            