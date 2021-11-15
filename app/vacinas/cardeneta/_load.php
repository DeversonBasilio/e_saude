<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 


if (CONEXAO == 'yes') {

    $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];

    if(isset($PESSOA_ID)) {
        
        $sql = "select 
                    P.id,
                    P.Procedimento,
                    C.data_vacina, 
                    C.dose
                from 		Carteirinhas C
                inner join 	Procedimento P on P.id = C.id_vacina
                where C.id_pessoa = ?";

        $stmt=$conn->prepare($sql);            
        $stmt->bind_param('s',$PESSOA_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        foreach ($result as $row) { 
            $data = array();
            $data['Proc_id']    = $row["id"];
            $data['Proc_nome']  = $row["Procedimento"];
            $data['Proc_data']  = date('d/m/Y', strtotime($row["data_vacina"]));
            $data['Proc_dose']    = $row["dose"];

            $vacinas[] = $data;  
        }
    }
}
?>