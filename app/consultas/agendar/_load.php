<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

function Mes_Nome($Mes_nome) {
    if($Mes_nome == 'January' )     { return 'Janeiro'; }
    if($Mes_nome == 'February' )    { return 'Fevereiro'; }
    if($Mes_nome == 'March' )       { return 'Março'; }
    if($Mes_nome == 'April' )       { return 'Abril'; }
    if($Mes_nome == 'May' )         { return 'Maio'; }
    if($Mes_nome == 'June' )        { return 'Junho'; }
    if($Mes_nome == 'July' )        { return 'Julho'; }
    if($Mes_nome == 'August' )      { return 'Agosto'; }
    if($Mes_nome == 'September' )   { return 'Setembro'; }
    if($Mes_nome == 'October' )     { return 'Outubro'; }
    if($Mes_nome == 'November' )    { return 'Novembro'; }
    if($Mes_nome == 'December' )    { return 'Dezembro'; }
}

if (CONEXAO == 'yes') 
{
    if(isset($_SESSION["USUARIOS"]['PersonID'])) {
        $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];

        $sql = 'select 	
                    C.id,
                    C.Ubs_id, 
                    C.Especialidade_id, 
                    U.nom_estab,
                    E.Especialidade,
                    C.Pessoa_id, 
                    C.Data_Consulta, 
                    C.Hora_Consulta,
                    C.Status_consulta,
                    DATE_FORMAT(C.Data_Consulta, "%d") as Dia_Agendado,
                    DATE_FORMAT(C.Data_Consulta, "%M") as Mes_Agendado,
                    C.Pessoa_id_insert
                From 			Consultas 		C
                inner	join	Especialidades 	E on E.id = C.Especialidade_id
                inner	join	Ubs				U on U.id = C.Ubs_id	
                where 	Pessoa_id = ?';
        
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('i',$PESSOA_ID );
        $stmt->execute();
        $result = $stmt->get_result();

        $minhas_consultas = [];

        foreach ($result as $row) { 
            $data = array();

            $data["consulta_id"]        = $row["id"];
            $data["Ubs_id"]             = $row["Ubs_id"];
            $data["Especialidade"]      = $row["Especialidade"];
            $data["nom_estab"]          = $row["nom_estab"];
            $data["Data_Consulta"]      = $row["Data_Consulta"];
            $data["Dia_Agendado"]       = $row["Dia_Agendado"];
            $data["Mes_Agendado"]       = Mes_Nome($row["Mes_Agendado"]);
            $data["Hora_Consulta"]      = $row["Hora_Consulta"];
            $data["Status_consulta"]    = $row["Status_consulta"];

            $minhas_consultas[] = $data; 
        }       
        
        
        /// Especialidades
        $sql = "SELECT id, Especialidade FROM Especialidades";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $Especialidades = null;

        foreach ($result as $row) { 
            $data = array();
            $data["Es_id"]         = $row["id"];
            $data["Es_dsc"]        = $row["Especialidade"];

            $Especialidades[]= $data;  
        }
        
        /// CIDADES
        $sql = "select id, nome from Cidade where atendemos = 1";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $Cidades = null;

        foreach ($result as $row) { 
            $data = array();
            $data["Cid_id"]       = $row["id"];
            $data["Cid_Nome"]     = $row["nome"];

            $Cidades[]= $data;  
        }
    }
}
?>