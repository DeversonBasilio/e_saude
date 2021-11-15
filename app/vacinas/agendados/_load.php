<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];
    $UBS_ID    = $_SESSION["UBS"];

    $sql = "SELECT id, Procedimento FROM Procedimento";

    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
        
    $Procedimentos = null;

    foreach ($result as $row) { 
        $data = array();
        $data["Pr_id"]         = $row["id"];
        $data["Pr_dsc"]        = $row["Procedimento"];

        $Procedimentos[]= $data;  
    }
}
?>