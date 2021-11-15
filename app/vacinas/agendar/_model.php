<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{    
    if(isset($_POST["DEL_AG_ID"])) {

        $ID_AGENDA = $_POST["DEL_AG_ID"];

        $sql = 'DELETE FROM Agendamentos where id = '.$ID_AGENDA;

        if ($conn->query($sql) === TRUE) {
            echo "sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }



    if(isset($_POST["ID_CIDADE_BUSCADA"]))
    {        

        $ID_CIDADE = $_POST["ID_CIDADE_BUSCADA"];

        /// UBS
        $sql = "select id, nom_estab, dsc_endereco, end_num, dsc_bairro, dsc_cidade from Ubs where id_cidade = ?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('i',$ID_CIDADE);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $Cidades = null;

        foreach ($result as $row) { 
    ?>
            <div class="card text-center">
                <div class="card-header">
                    <h6 class="text-center"><?php echo $row["nom_estab"]; ?></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php echo $row["dsc_endereco"].", ".$row["end_num"]; ?>
                    </div>
                    <div class="row">
                        <div class="col-10"><?php echo $row["dsc_bairro"].", ".$row["dsc_cidade"]; ?></div>
                        <div class="col-2"><button type="button" class="btn btn-success btn-circle" onclick='Seleciona_ubs(<?php echo $row["id"]; ?>)'> > </button></div>
                    </div>                        
                </div>
            </div>
    <?php
        }
    }

    if(isset($_POST["PROC_ID"]) && isset($_POST["UBS_ID"])) {

        $PROC_ID = $_POST["PROC_ID"];
        $UBS_ID  = $_POST["UBS_ID"];

        /// UBS
        $sql = "    select 		U.id as UBS_ID,
                                P.Procedimento,
                                nom_estab,
                                Data_Ini,
                                Data_Fim,
                                Horario_Ini,
                                Horario_Fim,
                                Vagas_Hora
                    from 		Ubs_Horarios 	UH
                    inner join 	Ubs				U	on U.id = Ubs_id
                    inner join  Procedimento	P	on P.id = Procedimento_id
                    where Procedimento_id   =   ?   and UH.Ubs_id = ? LIMIT 1";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('ii',$PROC_ID,$UBS_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        foreach($result as $row) {
?>              
            <h6 class="text-center"><?php echo $row["nom_estab"]; ?> </h6>
            <div class="row">
                <div class="selector col-md-1"></div>                    
            </div>
            <div class="row" id="div_erro_agenda"></div>
            <div class="row">
                <input type="hidden" id="Date_Select" />
                <input type="hidden" id="Horario_Select" />
                <button class="btn btn-primary col-md-1" onclick='Agendar_Horario(<?php echo $row["UBS_ID"].",".$PROC_ID; ?>)'> Agendar</button>
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

    if(isset($_POST["PROC_ID"]) && isset($_POST["UBS_ID"]) && isset($_POST["DATA_HORA"]) && isset($_POST["HORA_SEL"])) {
        $UBS_id   = $_POST["UBS_ID"];
        $Proc_id  = $_POST["PROC_ID"];
        $Data     = $_POST["DATA_HORA"];
        $Hora     = $_POST["HORA_SEL"];
        $PessoaID = $_SESSION["USUARIOS"]['PersonID'];
        
        $sql = 'INSERT INTO Agendamentos ( Pessoa_ID, Ubs_ID,  Procedimento_ID, Data_Agenda,Horario_Agenda)
                VALUES ( '.$PessoaID.' , '.$UBS_id.' , '.$Proc_id.' , "'.$Data.'" , "'.$Hora.'" )';

        if ($conn->query($sql) === TRUE) {
            echo "sucesso";
        } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>