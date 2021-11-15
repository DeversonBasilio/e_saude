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

    if($PESSOA_ID > 0 && $UBS > 0) {
        
         /// CARREGA UBS
        $sql = "    select 	UE.id, 
                            E.id as Especialidade_id, 
                            E.Especialidade, 
                            UE.Ativo, 
                            count(Uch.id) as Horarios
                    from 		Especialidades E 
                    left join 	Ubs_Especialidades UE on E.id = UE.Especialidade_id and UE.Ubs_id = ?
                    left join   Ubs_consultas_horarios Uch on E.id = Uch.Especialidade_id 
                    group by E.id, E.Especialidade, UE.Ativo";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('i',$UBS);
        $stmt->execute();
        $result = $stmt->get_result();

        foreach ($result as $row) { 

            $data = array();
            $data['Ubs_Especialidade_id']   = $row["id"];
            $data['Especialidade_id']       = $row["Especialidade_id"];
            $data['Especialidade']          = $row["Especialidade"];
            $data['Ativo']                  = (is_null($row["Ativo"]) || $row["Ativo"] == 0) ? 0 : 1;
            $data['Horarios']               = $row["Horarios"];

            $Ubs_Especialidades[] = $data;  
        }
    }
}
?>