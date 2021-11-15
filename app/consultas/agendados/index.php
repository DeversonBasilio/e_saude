<?php   define('ACTIVE_PAGE', 'consultas_agendados');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/consultas/agendados/_load.php');  ?>

<h4 class="text-center"> Consultas: Agendados </h4 class="text-center">
<hr/>

<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="form-floating mb-3 col-12">
                <select class="form-control text-center" id="sel_especialidade" onchange="Busca_Agendados()">
                    <option value="-1"> selecione </option>
<?php                   foreach($Especialidades as $Esp){                                                                                  ?>
                        <option value="<?php echo $Esp["Es_id"];?>"> <?php echo $Esp["Es_dsc"];?> </option>
<?php                   }                                                                                           ?>
                </select>
                <label for="sel_especialidade">Especialidades</label>
            </div>

            <div class="ms-3 selector"></div>
            <input type="hidden" id="data_sel" />
        </div>

        <div class="col-md-8" id="div_result"></div>
    </div>
</div>

<!-- script local com funções específicas da tela -->
<script src="/app/consultas/agendados/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>