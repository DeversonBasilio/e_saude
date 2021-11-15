<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];
    $UBS       = $_SESSION["UBS"];

    if(isset($_POST["PersonID"]) && isset($_POST["UBS"])) {
        $PESSOA_ID = $_POST["PersonID"];
        $UBS       = $_POST["UBS"];
    }
    
    if(isset($PESSOA_ID) && isset($UBS) && $UBS > 0) {
        
        
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


        $sql = "Select 	   H.id, 
                            Ubs_id, 
                Procedimento_id, 
                P.Procedimento,
                Data_Ini,
                Data_Fim,
                Horario_Ini,
                Horario_Fim,
                Vagas_Hora,
                Sabados,
                Domingos 
            from		Ubs_Horarios  H
            inner join 	Procedimento  P on P.id = H.Procedimento_id
            where 	Ubs_id = ? ";

        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$UBS);
        $stmt->execute();
        $result = $stmt->get_result();
            
        $Horarios = null;

        foreach ($result as $row) { 
            
            $data = array();
            $data["Hr_id"]              = $row["id"];
            $data["Hr_Ubs_id"]          = $row["Ubs_id"];
            $data["Hr_Procedimento_id"] = $row["Procedimento_id"];
            $data["Hr_Procedimento_dsc"] = $row["Procedimento"];
            $data["Hr_Data_Ini"]        = date('d/m/y', strtotime($row["Data_Ini"]));
            $data["Hr_Data_Fim"]        = date('d/m/y', strtotime($row["Data_Fim"]));
            $data["Hr_Horario_Ini"]     = $row["Horario_Ini"];
            $data["Hr_Horario_Fim"]     = $row["Horario_Fim"];
            $data["Hr_Vagas_Hora"]      = $row["Vagas_Hora"];

            $Horarios[]= $data;  
        }

    }
}
?>