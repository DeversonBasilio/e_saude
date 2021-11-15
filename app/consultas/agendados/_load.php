<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    $sql = "select id, Especialidade from Especialidades";

    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
        
    $Procedimentos = null;

    foreach ($result as $row) { 
        $data = array();
        $data["Es_id"]         = $row["id"];
        $data["Es_dsc"]        = $row["Especialidade"];

        $Especialidades[]= $data;  
    }
}
?>