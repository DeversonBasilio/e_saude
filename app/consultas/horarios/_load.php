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

    if($PESSOA_ID > 0 && $UBS > 0 && isset($_POST["Esp_id"])) {
        
        $Esp_id = $_POST["Esp_id"];
        $Esp_Nome = '';

            /// CARREGA UBS
        $sql = "    select 	UE.id, 
                        Uch.id as Uch_id,
                        E.id as Especialidade_id, 
                        E.Especialidade, 
                        UE.Ativo, 
                        Data_Ini, 
                        Data_Fim, 
                        Horario_Ini,
                        Horario_Fim,
                        atende_segunda,
                        atende_terca,
                        atende_quarta,
                        atende_quinta,
                        atende_sexta,
                        atende_sabado,
                        atende_domingos
                from 		Especialidades E 
                inner join 	Ubs_Especialidades UE on E.id = UE.Especialidade_id and UE.Ubs_id = ?
                inner join  Ubs_consultas_horarios Uch on E.id = Uch.Especialidade_id
                where E.id = ?  and excluido = 0 and Uch.Ubs_id = ?";
                
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('iii',$UBS, $Esp_id,$UBS);
        $stmt->execute();
        $result = $stmt->get_result();

        $Ubs_Especialidades_Horarios = [];

        foreach ($result as $row) { 

            $Esp_Nome = $row["Especialidade"];
            $Esp_id   = $row['Especialidade_id'];

            $data = array();
            $data['Ubs_Especialidade_id']   = $row["id"];
            $data['Especialidade_id']       = $row["Especialidade_id"];
            $data['Especialidade']          = $row["Especialidade"];
            $data['Data_Ini']               = $row["Data_Ini"];
            $data['Data_Fim']               = $row["Data_Fim"];
            $data['Horario_Ini']            = $row["Horario_Ini"];
            $data['Horario_Fim']            = $row["Horario_Fim"];
            $data['Uch_id']                 = $row["Uch_id"];

            $data["atende_segunda"]     = ($row["atende_segunda"] == 1 ? 'SIM' : 'NÃO');
            $data["atende_terca"]       = ($row["atende_terca"] == 1 ? 'SIM' : 'NÃO');
            $data["atende_quarta"]      = ($row["atende_quarta"] == 1 ? 'SIM' : 'NÃO');
            $data["atende_quinta"]      = ($row["atende_quinta"] == 1 ? 'SIM' : 'NÃO');
            $data["atende_sexta"]       = ($row["atende_sexta"] == 1 ? 'SIM' : 'NÃO');
            $data["atende_sabado"]      = ($row["atende_sabado"] == 1 ? 'SIM' : 'NÃO');
            $data["atende_domingos"]    = ($row["atende_domingos"] == 1 ? 'SIM' : 'NÃO');

            $Ubs_Especialidades_Horarios[] = $data;  
        }
    }
}
?>