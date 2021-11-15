<?php   define('ACTIVE_PAGE', 'consultas_agendar');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/consultas/agendar/_load.php');  ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<h4 class="text-center"> Consultas: Agenda </h4 class="text-center">
<hr/>

<div class="row" id="filtro_consulta">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header text-center" id="flush-headingOne">
                <button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Agendar ? Click aqui !
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
                                    <h6 class="text-center">Qual Médico/Especialidade procura?</h6>
                                    <div class="form-floating mb-3">
                                        <select class="form-control text-center" id="sel_especialidades" onchange="Busca_ubs_cidade_Esp()">
                                            <option value="-1"> selecione </option>
                    <?php                   foreach($Especialidades as $Esp){                                                                                  ?>
                                                <option value="<?php echo $Esp["Es_id"];?>"> <?php echo $Esp["Es_dsc"];?> </option>
                    <?php                   }                                                                                           ?>
                                        </select>
                                        <label for="sel_especialidades">Especialidades</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show " id="Step02" role="tabpanel" aria-labelledby="Step02-tab"> 
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual cidade deseja se consultar?</h6>
                                    <div class="form-floating mb-3">
                                        <select class="form-control text-center" id="sel_cidades" onchange="Busca_ubs_cidade_Esp()">
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
                        <div class="tab-pane fade show " id="Step03" role="tabpanel" aria-labelledby="Step03-tab"> 
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual Ubs procura ?</h6>
                                    <div class="form-floating mb-3" id="Ubs_esp"></div>
                                </div>
                            </div>     
                        </div>
                        <div class="tab-pane fade show " id="Step04" role="tabpanel" aria-labelledby="Step04-tab"> 
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center">Qual data deseja consultar?</h6>
                                    <div class="form-floating mb-3" id="Hour_div"></div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
     if($minhas_consultas) {
        foreach($minhas_consultas as $ConAgen) {         ?>
            <div class="card" style="col-12">
                <div class="card-header">
                    <div class="row">
                        <h5 class="text-center"><?php echo $ConAgen["Especialidade"]; ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-md-3">
                            <div class="row">
                                <h4 class="text-center"><?php echo $ConAgen["Dia_Agendado"]."</br>".$ConAgen["Mes_Agendado"]; ?></h4>
                                <h6 class="text-center"><?php echo $ConAgen["Hora_Consulta"]; ?></h6>
                            </div>
                        </div>
                        <div class="col">
                            <h6><?php echo $ConAgen["nom_estab"]; ?></h6>
                        </div>
                    </div>
                </div>
            </div> 
<?php                   }
    }
    else {                                                  ?>
        <h5 class="text-center"> Nenhuma consulta agendada! </h5>
<?php    }  ?>

<!-- script local com funções específicas da tela -->
<script src="/app/consultas/agendar/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>