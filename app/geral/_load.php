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

if (CONEXAO == 'yes') {

    if(isset($_SESSION["UBS"]) && $_SESSION["UBS"] == 0) {

        $PESSOA_ID  = $_SESSION['USUARIOS']['PersonID'];

        /// AGENDAS 
        $sql = 'select 
                    A.id,
                    P.Procedimento,
                    U.nom_estab,
                    Pe.Nome,
                    DATE_FORMAT(A.Data_Agenda, "%d") as Dia_Agendado,
                    DATE_FORMAT(A.Data_Agenda, "%M") as Mes_Agendado,
                    A.Horario_Agenda
                from 		Agendamentos 	A
                inner  join Procedimento	P	on A.Procedimento_ID = P.id
                inner  join Pessoa			Pe	on A.Pessoa_ID		 = Pe.id
                inner  join Ubs				U	on A.Ubs_ID			 = U.id
                inner  join Cidade			C	on C.id 		     = U.id_cidade
                where A.Pessoa_ID = ?       and C.atendemos = 1 
                order by A.Data_Agenda desc LIMIT 5';

        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$PESSOA_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        $Vacinas_Agendadas = null;

        foreach ($result as $row) { 

            $data = array();
            $data["Ag_id"]              = $row["id"];
            $data["Ag_Procedimento"]    = $row["Procedimento"];
            $data["Ag_nom_estab"]       = $row["nom_estab"];
            $data["Ag_Dia_Agendado"]    = $row["Dia_Agendado"];
            $data["Ag_Mes_Agendado"]    = Mes_Nome($row["Mes_Agendado"]);
            $data["Ag_Horario_Agenda"]  = $row["Horario_Agenda"];
            
            $Vacinas_Agendadas[]= $data;  
        }

        $sql = 'select 	
                C.id,
                C.Ubs_id, 
                C.Especialidade_id, 
                U.nom_estab,
                E.Especialidade,
                C.Pessoa_id, 
                C.Data_Consulta, 
                DATE_FORMAT(C.Data_Consulta, "%d") as Dia_Agendado,
                DATE_FORMAT(C.Data_Consulta, "%M") as Mes_Agendado,
                C.Hora_Consulta,
                C.Status_consulta,
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

            $data["nom_estab"]          = $row["nom_estab"];
            $data["Especialidade"]      = $row["Especialidade"];
            $data["Dia_Agendado"]    = $row["Dia_Agendado"];
            $data["Mes_Agendado"]    = Mes_Nome($row["Mes_Agendado"]);
            $data["Hora_Consulta"]      = $row["Hora_Consulta"];
            $data["Status_consulta"]    = $row["Status_consulta"];

            $minhas_consultas[] = $data; 
        }    
    }



    if(isset($_SESSION["UBS"]) && $_SESSION["UBS"] > 0) {

        $UBS_ID  = $_SESSION["UBS"];

        /// AGENDAS 
        $sql = 'select 
                A.id,
                P.Procedimento,
                U.nom_estab,
                A.Ubs_ID,
                Pe.Nome,
                DATE_FORMAT(A.Data_Agenda, "%d") as Dia_Agendado,
                DATE_FORMAT(A.Data_Agenda, "%M") as Mes_Agendado,
                A.Horario_Agenda
            from 		Agendamentos 	A
            inner  join Procedimento	P	on A.Procedimento_ID = P.id
            inner  join Pessoa			Pe	on A.Pessoa_ID		 = Pe.id
            inner  join Ubs				U	on A.Ubs_ID			 = U.id
            inner  join Cidade			C	on C.id 		     = U.id_cidade
            where A.Ubs_ID = ?     	and C.atendemos = 1 
            order by A.Data_Agenda desc LIMIT 5';

        $stmt=$conn->prepare($sql);
        $stmt->bind_param('i',$UBS_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        $Vacinas_Agendadas = null;

        foreach ($result as $row) { 

            $data = array();
            $data["Ag_id"]              = $row["id"];
            $data["Ag_Procedimento"]    = $row["Procedimento"];
            $data["Nome"]               = $row["Nome"];
            $data["Ag_nom_estab"]       = $row["nom_estab"];
            $data["Ag_Dia_Agendado"]    = $row["Dia_Agendado"];
            $data["Ag_Mes_Agendado"]    = Mes_Nome($row["Mes_Agendado"]);
            $data["Ag_Horario_Agenda"]  = $row["Horario_Agenda"];
            
            $Vacinas_Agendadas[]= $data;  
        }
        
        $sql = 'select 	
                C.id,
                C.Ubs_id, 
                C.Especialidade_id, 
                U.nom_estab,
                E.Especialidade,
                C.Pessoa_id, 
                Pe.Nome as nome_pessoa,
                C.Data_Consulta, 
                DATE_FORMAT(C.Data_Consulta, "%d") as Dia_Agendado,
                DATE_FORMAT(C.Data_Consulta, "%M") as Mes_Agendado,
                C.Hora_Consulta,
                C.Status_consulta,
                C.Pessoa_id_insert
            From 			Consultas 		C
            inner	join	Especialidades 	E on E.id = C.Especialidade_id
            inner	join	Ubs				U on U.id = C.Ubs_id	
            inner   join 	Pessoa			Pe on C.Pessoa_id = Pe.id
            where 	U.id = ?';

        $stmt=$conn->prepare($sql);        
        $stmt->bind_param('i',$UBS_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        $minhas_consultas = [];

        foreach ($result as $row) { 
            $data = array();

            $data["nom_estab"]          = $row["nom_estab"];
            $data["Especialidade"]      = $row["Especialidade"];
            $data["Dia_Agendado"]       = $row["Dia_Agendado"];
            $data["nome_pessoa"]        = $row["nome_pessoa"];
            $data["Mes_Agendado"]       = Mes_Nome($row["Mes_Agendado"]);
            $data["Hora_Consulta"]      = $row["Hora_Consulta"];
            $data["Status_consulta"]    = $row["Status_consulta"];

            $minhas_consultas[] = $data; 
        }  
    }
}   
?>