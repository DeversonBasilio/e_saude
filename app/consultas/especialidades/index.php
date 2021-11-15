<?php   define('ACTIVE_PAGE', 'vacinas_agendar');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/consultas/especialidades/_load.php');  ?>

<h4 class="text-center"> Especialidades: Cadastrado </h4 class="text-center">
<hr/>

<div class="container">
    <table class="table table-bordered table-responsive" id="tb_esp">
        <thead>
            <tr>
                <th>Especialidade</th>
                <th>Horários</th>
                <th>Ativa</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php           foreach($Ubs_Especialidades as $Ubs_Esp){           ?>
                <tr>
                    <td><?php echo $Ubs_Esp["Especialidade"] ?></td>
                    <td><?php echo ($Ubs_Esp["Horarios"] > 0 ? 'Cadastrados':'Não cadastrados') ?></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                <?php echo ($Ubs_Esp["Ativo"] == 1 ? 'Checked' : ' ') ?>   onchange="switch_especialidade(<?php echo $Ubs_Esp['Especialidade_id'].','.$Ubs_Esp['Ativo']; ?>)" >
                        </div>
                    </td>
                    <td>
                        <form action="/app/consultas/horarios/index.php" method="POST">
                            <input type="hidden" name="Esp_id" value="<?php echo $Ubs_Esp['Especialidade_id'] ?>" />
                            <button type="submit" class="btn btn-primary col-12">Horários</button>
                        </form>
                    </td>
                </tr>
<?php           }                                                   ?>
        </tbody>
    </table>
</div> 

<!-- script local com funções específicas da tela -->
<script src="/app/consultas/especialidades/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>