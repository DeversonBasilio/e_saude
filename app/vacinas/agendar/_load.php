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

    $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];
        
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
            where A.Pessoa_ID = ?       and C.atendemos = 1 ';

    $stmt=$conn->prepare($sql);
    $stmt->bind_param('s',$PESSOA_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    $Agendamentos = null;

    foreach ($result as $row) { 

        $data = array();
        $data["Ag_id"]              = $row["id"];
        $data["Ag_Procedimento"]    = $row["Procedimento"];
        $data["Ag_nom_estab"]       = $row["nom_estab"];
        $data["Ag_Dia_Agendado"]    = $row["Dia_Agendado"];
        $data["Ag_Mes_Agendado"]    = Mes_Nome($row["Mes_Agendado"]);
        $data["Ag_Horario_Agenda"]  = $row["Horario_Agenda"];

        $Agendamentos[]= $data;  
    }


    /// PROCEDIMENTOS
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
?>