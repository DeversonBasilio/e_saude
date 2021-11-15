<?php   define('ACTIVE_PAGE', 'vacinas_agendar');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/vacinas/horarios/_load.php');  ?>

<h4 class="text-center"> Vacinas: Horários </h4 class="text-center">
<hr/>


    <input type="hidden" id="UBS_ID" value="<?php echo $_SESSION["UBS"]; ?>" />
    <input type="hidden" id="PessoaID" value="<?php echo $_SESSION["USUARIOS"]["PersonID"]; ?>" />

    <div class="row">
        <div class="col-md-4">
            <div class="form-floating mb-3 col-12">
                <select class="form-control text-center" id="sel_procedimentos">
                    <option value="-1"> selecione </option>
        <?php                   foreach($Procedimentos as $Proc){                                                                                  ?>
                        <option value="<?php echo $Proc["Pr_id"];?>"> <?php echo $Proc["Pr_dsc"];?> </option>
        <?php                   }                                                                                           ?>
                </select>
                <label for="sel_procedimentos">Procedimentos</label>
            </div>

            <div class="col-12">
                <button class="btn btn-primary btn-lg col-12" onclick="add_agenda()">
                    Adicionar
                </button>
            </div>
        </div>
            

        <div class="col-12 col-md-2">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="date"   name="DATAINI" class="form-control text-center" id="ipt_DATAINI" />
                    <label for="ipt_DATAINI">Data inícial</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="date"   name="DATAFIM" class="form-control text-center" id="ipt_DATAFIM"  />
                    <label for="ipt_DATAFIM">Data Final</label>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-2">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="time"   name="HORAINI" class="form-control text-center" id="ipt_HORAINI" />
                    <label for="ipt_HORAINI">Hora Inicial</label>
                </div>
            </div>            
            
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="time"   name="HORAFIM" class="form-control text-center" id="ipt_HORAFIM" />
                    <label for="ipt_HORAFIM">Hora Final</label>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-2">
            <div class="form-floating mb-3">
                <input type="number"   name="Vagas" class="form-control text-center" id="ipt_Vagas" />
                <label for="ipt_Vagas">Vagas/hora</label>
            </div>
        </div>
    </div>

<div id="div_error"></div>

    <h6> Horários Criados </h6>
    <hr>
    <div class="row">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th rowspan=2>Procedimento</th>
                    <th colspan=2>DATA</th>
                    <th colspan=2>Horario</th>
                    <th rowspan=2>Vagas/Hora</th>                    
                </tr>
                <tr>
                    <th>Início</th>
                    <th>Fim   </th>
                    <th>Início</th>
                    <th>Fim   </th>
                </tr>
            </thead>
            <tbody>
<?php           if(!isset($Horarios)) {                                                               ?>
                <tr>
                    <td colspan=8> Nenhum Horário encontrado! </td>
                </tr>
<?php           } else {
                foreach($Horarios as $Horario){                                                    ?>
                    <tr>
                        <td><?php echo $Horario["Hr_Procedimento_dsc"]; ?></td>
                        <td><?php echo $Horario["Hr_Data_Ini"];     ?></td>
                        <td><?php echo $Horario["Hr_Data_Fim"];        ?></td>
                        <td><?php echo $Horario["Hr_Horario_Ini"];     ?></td>
                        <td><?php echo $Horario["Hr_Horario_Fim"];     ?></td>
                        <td><?php echo $Horario["Hr_Vagas_Hora"];      ?></td>
                    </tr>
<?php               }
            }                                                                                       ?>
            </tbody>
        </table>
    </div>
    
</div>


<style>
    select, option {
        text-align: center;
        text-align-last: center;
    }
</style>

<!-- script local com funções específicas da tela -->
<script src="/app/vacinas/horarios/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>