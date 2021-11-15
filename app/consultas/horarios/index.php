<?php   define('ACTIVE_PAGE', 'vacinas_agendar');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/consultas/horarios/_load.php');  ?>

<h4 class="text-center"> Consultas: Horários </h4 class="text-center">
<hr/>

<div class="row">
    <h6> Novo Horários</h6>

    <input type="hidden" id="Esp_id" value="<?php echo $Esp_id; ?>" />
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="date" name="data_ini" id="dt_data_ini" class="form-control" /></th>
                <th><input type="date" name="data_fim" id="dt_data_fim" class="form-control" /></th>
                <th><input type="time" name="hora_ini" id="hora_ini"    class="form-control" /></th>
                <th><input type="time" name="hora_fim" id="hora_fim"    class="form-control" /></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check_seg" checked />
                        <label class="form-check-label" for="check_seg">Segunda-feira
                    </div>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check_ter" checked />
                        <label class="form-check-label" for="check_ter">Terça-feira</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check_qua" checked>
                        <label class="form-check-label" for="check_qua">Quarta-feira</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-switch">    
                        <input class="form-check-input" type="checkbox" id="check_quin" checked>
                        <label class="form-check-label" for="check_quin">Quinta-feira</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check_sex" checked>
                        <label class="form-check-label" for="check_sex">Sexta-feira</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check_sab" checked>
                        <label class="form-check-label" for="check_sab">Sábado</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check_dom" checked>
                        <label class="form-check-label" for="check_dom">Domingo</label>
                    </div>
                </td>
                <td>
                    <button type="button" name="btn_add_hour" id="btn_add_hour" class="btn btn-primary" onclick="add_hour_esp()"> 
                        Adicionar
                    </button>
                </td>
            </tr>
        </tbody>
    </table>                  

</div>

<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th rowspan=2>Especialidade</th>
            <th colspan=2> Data </th>
            <th colspan=2> Horário</th>
            <th colspan=7> Dias de Atendimento </th>
            <th rowspan=2 ></th>
        </tr>
        <tr>
            <th>Inicial</th>
            <th>Final</th>
            <th>Inicial</th>
            <th>Final</th>

            <th>Segunda</th>
            <th>Terça</th>
            <th>Quarta</th>
            <th>Quinta</th>
            <th>Sexta</th>
            <th>Sábado</th>
            <th>Domingo</th>

        </tr>
    </thead>
    <tbody>
<?php           foreach($Ubs_Especialidades_Horarios as $UEH )   {          ?>
            <tr>
                <td><?php echo $UEH["Especialidade"]; ?></td>
                <td><?php echo $UEH["Data_Ini"]; ?></td>
                <td><?php echo $UEH["Data_Fim"]; ?></td>
                <td><?php echo $UEH["Horario_Ini"]; ?></td>
                <td><?php echo $UEH["Horario_Fim"]; ?></td>

                <td><?php echo $UEH["atende_segunda"]; ?></td>
                <td><?php echo $UEH["atende_terca"]; ?></td>
                <td><?php echo $UEH["atende_quarta"]; ?></td>
                <td><?php echo $UEH["atende_quinta"]; ?></td>
                <td><?php echo $UEH["atende_sexta"]; ?></td>
                <td><?php echo $UEH["atende_sabado"]; ?></td>
                <td><?php echo $UEH["atende_domingos"]; ?></td>                            
                <td>
<?php                       if(isset($UEH["Uch_id"])) {                                   ?>
                        <button class="btn btn-danger col-12" onclick="Excluir_Horario(<?php echo $UEH['Uch_id']; ?>)">
                            X
                        </button>
<?php                       }                                               ?>
                </td>
            </tr>
<?php           }                                                           ?>
    </tbody>
</table>

</div>


<!-- script local com funções específicas da tela -->
<script src="/app/consultas/horarios/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>