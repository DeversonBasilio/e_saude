<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    if( isset($_POST["PessoaID"]) &&    isset($_POST["UBS_id"])     &&  isset($_POST["Proc_id"])    && 
        isset($_POST["data_ini"]) &&    isset($_POST["data_fim"])   &&  isset($_POST["hora_ini"])   &&
        isset($_POST["hora_fim"]) &&    isset($_POST["vagashora"])  ) 
    {

        $PessoaID = $_POST["PessoaID"];
        $UBS_id   = $_POST["UBS_id"];
        $Proc_id  = $_POST["Proc_id"];
        $data_ini = $_POST["data_ini"];
        $data_fim = $_POST["data_fim"];
        $hora_ini = $_POST["hora_ini"];
        $hora_fim = $_POST["hora_fim"];
        $vagashora= $_POST["vagashora"];
        
        $sql = "INSERT INTO Ubs_Horarios(	Ubs_id, 
                                            Procedimento_id, 
                                            Data_Ini, 		
                                            Data_Fim, 
                                            Horario_Ini, 
                                            Horario_Fim, 		
                                            Vagas_Hora, 
                                            Pessoa_ID)
                VALUES( ".$UBS_id." , 
                        ".$Proc_id." , 
                        '".$data_ini."' , 
                        '".$data_fim."' , 
                        '".$hora_ini."' , 
                        '".$hora_fim."' , 
                        ".$vagashora.", 
                        ".$PessoaID.")";

        if ($conn->query($sql) === TRUE) {
            echo "sucesso";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>