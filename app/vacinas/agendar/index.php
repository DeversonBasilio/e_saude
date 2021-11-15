<?php   define('ACTIVE_PAGE', 'vacinas_agendar');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/vacinas/agendar/_load.php');  ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<h4 class="text-center"> Vacinas: Agenda </h4 class="text-center">
<hr/>

<div id="filtro_marca">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header text-center" id="flush-headingOne">
                <button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Agendar
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="row">
                    
                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <button class="nav-link active"   id="Step01-tab" data-bs-toggle="tab" data-bs-target="#Step01" type="button" role="tab" aria-controls="Step01" aria-selected="true"> 1º Passo</button>
                        <button class="nav-link"          id="Step02-tab" data-bs-toggle="tab" data-bs-target="#Step02" type="button" role="tab" aria-controls="Step02" aria-selected="false">2º Passo</button>
                        <button class="nav-link"          id="Step03-tab" data-bs-toggle="tab" data-bs-target="#Step03" type="button" role="tab" aria-controls="Step03" aria-selected="false">3º Passo</button>
                        <button class="nav-link"          id="Step04-tab" data-bs-toggle="tab" data-bs-target="#Step04" type="button" role="tab" aria-controls="Step04" aria-selected="false">4º Passo</button>
                    </nav>
                    
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Step01" role="tabpanel" aria-labelledby="Step01-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual vacina procura?</h6>
                                    <div class="form-floating mb-3">
                                        <select class="form-control text-center" id="sel_procedimentos">
                                            <option value="-1"> selecione </option>
                    <?php                   foreach($Procedimentos as $Proc){                                                                                  ?>
                                                <option value="<?php echo $Proc["Pr_id"];?>"> <?php echo $Proc["Pr_dsc"];?> </option>
                    <?php                   }                                                                                           ?>
                                        </select>
                                        <label for="sel_procedimentos">Vacinas</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Step02" role="tabpanel" aria-labelledby="Step02-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual cidade deseja realizar?</h6>
                                    <div class="form-floating mb-3">
                                        <select class="form-control text-center" id="sel_cidades" onclick="Busca_ubs_cidade()">
                                            <option value="-1"> selecione </option>
                    <?php                   foreach($Cidades as $cidade){                                                                                  ?>
                                                <option value="<?php echo $cidade["Cid_id"];?>"> <?php echo $cidade["Cid_Nome"];?> </option>
                    <?php                   }                                                                                           ?>
                                        </select>
                                        <label for="sel_cidades">Cidade</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Step03" role="tabpanel" aria-labelledby="Step03-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual Ubs deseja realizar?</h6>
                                    <div class="form-floating mb-3" id="ubs_div">
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Step04" role="tabpanel" aria-labelledby="Step04-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual Horário desejar marcar?</h6>
                                    <div id="Hour_div">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="div_result"></div>

<div id="lista_marca">
    
<?php   if(isset($Agendamentos)) {
            foreach($Agendamentos as $Agenda){                          ?>                  
                <div class="card" style="col-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10 text-center display-6"><?php echo $Agenda["Ag_Procedimento"]; ?></div>
                            <div class="col-2"><button type="button" class="btn btn-danger btn-circle" onclick='Deleta_Agenda(<?php echo $Agenda["Ag_id"]; ?>)'> X </button></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 col-md-3">
                                <div class="row">
                                    <h3><?php echo $Agenda["Ag_Dia_Agendado"]; ?></h3></br>
                                    <h5><?php echo $Agenda["Ag_Mes_Agendado"]; ?></h5>
                                </div>
                                <div class="row">
                                    <h6><?php echo $Agenda["Ag_Horario_Agenda"]; ?></h6>
                                </div>
                            </div>
                            <div class="col-8 col-md-8">
                                <h6><?php echo $Agenda["Ag_nom_estab"]; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
<?php           }
            } else {
                echo '<h6> Nenhum agendamento encontrado!</h6>';
        }                                                        ?>
</div>

<!-- script local com funções específicas da tela -->
<script src="/app/vacinas/agendar/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>