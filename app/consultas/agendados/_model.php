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
    if(isset($_POST["ESP_ID"]) && isset($_POST["Data_Agenda"]) && isset($_SESSION["UBS"])) 
    {
        $UBS_ID  = $_SESSION["UBS"];
        $ESP_ID = $_POST["ESP_ID"];
        $DATA_AGENDA = date('Y-m-d', strtotime($_POST["Data_Agenda"])) ;   
        
        $sql = 'select 	
                C.id,
                C.Ubs_id, 
                C.Especialidade_id, 
                U.nom_estab,
                E.Especialidade,
                C.Pessoa_id, 
                Pe.Nome,
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
            where 	U.id = ?
            and     E.id = ?
            and     C.Data_Consulta = "'.$DATA_AGENDA.'" ';
        
        $stmt=$conn->prepare($sql);        
        $stmt->bind_param('ii',$UBS_ID,$ESP_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        $minhas_consultas = [];

        foreach ($result as $row) { 
            $data = array();

            $data["nom_estab"]          = $row["nom_estab"];
            $data["Especialidade"]      = $row["Especialidade"];
            $data["Dia_Agendado"]       = date('d/m/Y', strtotime($row["Data_Consulta"]));
            $data["Nome"]               = $row["Nome"];
            $data["Mes_Agendado"]       = Mes_Nome($row["Mes_Agendado"]);
            $data["Hora_Consulta"]      = $row["Hora_Consulta"];
            $data["Status_consulta"]    = $row["Status_consulta"];

            $minhas_consultas[] = $data; 
        }   
?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>Dia agendado</th>
                    <th>Hora</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
                foreach($minhas_consultas as $cons) {
?>
                    <tr>
                        <td><?php echo $cons["Nome"]; ?></td>
                        <td><?php echo $cons["Especialidade"]; ?></td>
                        <td><?php echo $cons["Dia_Agendado"]; ?></td>
                        <td><?php echo $cons["Hora_Consulta"]; ?></td>
                        <td><?php echo $cons["Status_consulta"]; ?></td>
                        <td></td>
                    </tr>
<?php
                }
?>
            </tbody>
        </table>
<?php
    }
}
?>
