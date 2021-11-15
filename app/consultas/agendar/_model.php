<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    if(isset($_POST["ESP_ID"]) && isset($_POST["Cidade_id"]))
        {
            $ESP_ID = $_POST["ESP_ID"];
            $Cidade_id = $_POST["Cidade_id"];

            $sql = "select  U.id, 
                            U.nom_estab, 
                            U.dsc_endereco, 
                            U.end_num, 
                            U.dsc_bairro,
                            U.dsc_cidade
                    from 		Ubs U
                    inner join  Ubs_consultas_horarios Uch on U.id = Uch.Ubs_id
                    where Uch.Especialidade_id = ? and U.id_cidade = ? and Uch.excluido = 0";
            
            $stmt=$conn->prepare($sql);
            $stmt->bind_param('ii',$ESP_ID, $Cidade_id );
            $stmt->execute();
            $result = $stmt->get_result();

            foreach ($result as $row) {  
?>
                <div class="card text-center">
                    <div class="card-header">
                        <h6 class="text-center"><?php echo $row["nom_estab"]; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <?php echo $row["dsc_endereco"].", ".$row["end_num"]; ?>
                        </div>
                        <div class="row">
                            <div class="col-10"><?php echo $row["dsc_bairro"].", ".$row["dsc_cidade"]; ?></div>
                            <div class="col-2"><button type="button" class="btn btn-success btn-circle" onclick='Seleciona_ubs_consulta(<?php echo $row["id"]; ?>)'> O </button></div>
                        </div>                        
                    </div>
                </div>
<?php
            } 
        }

    if(isset($_POST["Esp_id"]) && isset($_POST["UBS_ID"])) {
        
        $Esp_id = $_POST["Esp_id"];
        $UBS_ID  = $_POST["UBS_ID"];
        
        /// UBS
        $sql = "    select  
                        U.nom_estab,
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
                    from Ubs_consultas_horarios Uch
                    inner join Ubs U on U.id = Uch.Ubs_id
                    where Ubs_id = ? and Especialidade_id = ? and excluido = 0 and Data_Fim > CURDATE()  LIMIT 1";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('ii',$UBS_ID,$Esp_id,);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $row_cnt = mysqli_num_rows($result);
        
        if($row_cnt == 0) {
?>
            <div class="row">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Nenhum horário encontrado! 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
<?php
        }

        foreach($result as $row) {
?>
            <h6 class="text-center"><?php echo $row["nom_estab"]; ?> </h6>
            <div class="row text-center">
                <div class="selector"></div>                    
            </div>
            <div class="row" id="div_erro_agenda"></div>
            <div class="row">
                <input type="hidden" id="Date_Select" />
                <input type="hidden" id="Horario_Select" />
                <button class="btn btn-primary col" onclick='Agendar_Consulta(<?php echo $UBS_ID.",".$Esp_id; ?>)'> Agendar</button>
            </div>
            <script>
                    var optional_config = {
                    inline: true,
                    enable: [
                        {
                            from: "<?php echo $row["Data_Ini"]; ?>",
                            to: "<?php echo $row["Data_Fim"]; ?>"
                        }
                    ],
                    enableTime: true,
                    minTime: "<?php echo $row["Horario_Ini"]; ?>",
                    maxTime: "<?php echo $row["Horario_Fim"]; ?>",
                    time_24hr: true,
                    onChange: function(selectedDates, dateStr, instance) {
                        selectedDates.forEach(function (date){
                            $("#Date_Select").val(date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate());
                            $("#Horario_Select").val(date.getHours()+':'+date.getMinutes());
                        })
                    }
                }
                $(".selector").flatpickr(optional_config);
            </script>
<?php

        }
    }


    if  (       isset($_POST["Especialidade_id"])       &&  isset($_POST["UBS_ID"]) 
            &&  isset($_POST["DATA_AGENDA"])            &&  isset($_POST["HORA_AGENDA"])    ) {
        
        $UBS_ID = $_POST["UBS_ID"];
        $Esp_id = $_POST["Especialidade_id"];
        $Data_Agenda = $_POST["DATA_AGENDA"];
        $Hora_Agenda = $_POST["HORA_AGENDA"];
        $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];

        $sql = '    INSERT Consultas(   Ubs_id          , Especialidade_id     , Pessoa_id, 
                                        Data_Consulta   , Hora_Consulta        , Status_consulta, 
                                        Pessoa_id_insert, data_insert          , Pessoa_id_update, data_update)
                    values(             '.$UBS_ID.'         ,'.$Esp_id.'       ,'.$PESSOA_ID.',
                                        "'.$Data_Agenda.'"  ,"'.$Hora_Agenda.'","Agendado",
                                        '.$PESSOA_ID.'      ,now()             ,'.$PESSOA_ID.',     now())';

        echo $sql;

        if ($conn->query($sql) === TRUE) {
            echo "sucesso";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }        
}