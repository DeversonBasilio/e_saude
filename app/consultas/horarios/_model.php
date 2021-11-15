<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
         
    if( isset($_POST["DATA_INI"]) &&    isset($_POST["DATA_FIM"])   &&    isset($_POST["HORA_INI"]) &&      isset($_POST["HORA_FIM"])   &&
    isset($_POST["SEG"])      &&    isset($_POST["TER"])        &&    isset($_POST["QUA"])      &&      isset($_POST["QUI"])        &&
    isset($_POST["SEX"])      &&    isset($_POST["SAB"])        &&    isset($_POST["DOM"])      &&      isset($_SESSION["USUARIOS"]['PersonID']) &&
    isset($_SESSION["UBS"])   &&    isset($_POST["ESP_ID"])) 
    {
        
        $UBS_ID     = $_SESSION["UBS"];
        $PESSOA_ID  = $_SESSION["USUARIOS"]['PersonID'];
        $ESP_ID     = $_POST["ESP_ID"];

        $DATA_INI   = $_POST["DATA_INI"];
        $DATA_FIM   = $_POST["DATA_FIM"];
        $HORA_INI   = $_POST["HORA_INI"];
        $HORA_FIM   = $_POST["HORA_FIM"];

        $SEG    = ($_POST["SEG"]) == 'true' ? 1 : 0;
        $TER    = ($_POST["TER"]) == 'true' ? 1 : 0;
        $QUA    = ($_POST["QUA"]) == 'true' ? 1 : 0;
        $QUI    = ($_POST["QUI"]) == 'true' ? 1 : 0;
        $SEX    = ($_POST["SEX"]) == 'true' ? 1 : 0;
        $SAB    = ($_POST["SAB"]) == 'true' ? 1 : 0;
        $DOM    = ($_POST["DOM"]) == 'true' ? 1 : 0;

        $sql = "    INSERT INTO Ubs_consultas_horarios
                    (   Ubs_id          , Especialidade_id  ,   Data_ini        ,   Data_Fim            ,   Horario_Ini  ,    Horario_Fim,
                        atende_segunda  , atende_terca      ,   atende_quarta   ,   atende_quinta       ,   atende_sexta ,    atende_sabado, atende_domingos , 
                        Pessoa_id_criou   ,   data_criacao    ,   Pessoa_id_alterou   ,   data_alteracao,   excluido)
                    values
                    (
                        ".$UBS_ID.", ".$ESP_ID.", ? , ? , ?, ?,
                        ?, ? , ? , ? , ? , ?,?, 
                        ".$PESSOA_ID." , now() , ".$PESSOA_ID." , now(), 0
                    ) ";

        // Prepare the statement.
        $statement = $conn->prepare($sql);
                
        // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
        $statement->bind_param('ssssiiiiiii', $DATA_INI, $DATA_FIM, $HORA_INI, $HORA_FIM, $SEG, $TER, $QUA, $QUI, $SEX, $SAB, $DOM);
                        
        if($statement->execute()) {
            echo 'success';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }

    if(isset($_POST["UCH_ID"])) {
        
        $PESSOA_ID  = $_SESSION["USUARIOS"]['PersonID'];
        $UCH_ID     = $_POST["UCH_ID"];

        $sql = "update Ubs_consultas_horarios set excluido = 1, Pessoa_id_alterou = ?, data_alteracao = now() where id = ?";

        // Prepare the statement.
        $statement = $conn->prepare($sql);
                
        // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
        $statement->bind_param('ii', $PESSOA_ID, $UCH_ID);
                        
        if($statement->execute()) {
            echo 'success';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }

}
}
?>