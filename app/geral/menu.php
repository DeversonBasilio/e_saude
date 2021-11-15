<?php   define('ACTIVE_PAGE', 'menu');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/geral/_load.php');           ?>

<div class="row" id="div_conteudo">

<!-- CASO NÃO TENHA ESCOLHIDO QUAL PERFIL  -->
<?php if(isset($_SESSION["UBS"]) && $_SESSION["UBS"] == -1) {      ?>

    <h5 class="text-center"> Qual perfil deseja utilizar?</h5>
    <div class="d-flex justify-content-center col-md-8 col-12">

        <div class="card col-4 col-md-2 ms-2 mb-2 text-center">
            <div class="card-body text-center">
                <a  class="" onclick="escolher_perfil(1)">
                    <img src="/ext/images/person.png" class="img-fluid" id="imgperfil">
                    <label for="imgperfil" class="text-center">Pessoal</label>
                </a>
            </div>
        </div>

        <div class="card col-4 col-md-2 ms-2 mb-2 text-center">
            <div class="card-body text-center">
                <a  class="text-center" onclick="escolher_perfil(2)">
                    <img src="/ext/images/US.png" class="img-fluid" id="imgperfil">
                    <label for="imgperfil" class="text-center">Profissional</label>
                </a>
            </div>
        </div>

    </div>
<!-- CASO TENHA ESCOLHIDO QUAL PERFIL PESSOAL  -->    
<?php   } elseif(isset($_SESSION["UBS"]) && $_SESSION["UBS"] == 0) {                        ?>
            <div class="col-md-4 col-12  mt-3 mb-3">
                <h4 class="text-center"> Minhas Vacinas Agendadas </h4>
                                                     
<?php           if($Vacinas_Agendadas) {
                    foreach($Vacinas_Agendadas as $VacAgen) {       ?>
                        <div class="card" style="col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h5 class="text-center"><?php echo $VacAgen["Ag_Procedimento"]; ?></h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <div class="row">
                                            <h4 class="text-center"><?php echo $VacAgen["Ag_Dia_Agendado"]."</br>".$VacAgen["Ag_Mes_Agendado"]; ?></h4>
                                            <h6 class="text-center"><?php echo $VacAgen["Ag_Horario_Agenda"]; ?></h6>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6><?php echo $VacAgen["Ag_nom_estab"]; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>        
<?php               }
                } 
                else    {   
?>
                    <h5 class="text-center"> Nenhuma vacina agendada! </h5>
<?php           }
?>
            </div>
            <div class="col-md-4 col-12 mt-3 mb-3">
                <h4 class="text-center"> Minhas Consultas Agendadas </h4>
    
<?php           if($minhas_consultas) {
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
<?php           }                                                       ?>
            </div>
<?php
        } 
        else  {   //CASO TENHA ESCOLHIDO UMA UBS                                                                                                               ?>  
            <div class="col-md-4 col-12  mt-3 mb-3">
                <h4 class="text-center">Ultimas Vacinas Agendadas</h4>
                                                     
<?php           if($Vacinas_Agendadas) {
                    foreach($Vacinas_Agendadas as $VacAgen) {       ?>
                        <div class="card" style="col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h4 class="text-center"><?php echo $VacAgen["Ag_Procedimento"]; ?></h4>
                                    <h5 class="text-center"><?php echo $VacAgen["Nome"]; ?></h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <div class="row">
                                            <h4 class="text-center"><?php echo $VacAgen["Ag_Dia_Agendado"]."</br>".$VacAgen["Ag_Mes_Agendado"]; ?></h4>
                                            <h6 class="text-center"><?php echo $VacAgen["Ag_Horario_Agenda"]; ?></h6>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6><?php echo $VacAgen["Ag_nom_estab"]; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>        
<?php               }
                } 
                else    {   
?>
                    <h5 class="text-center"> Nenhuma vacina agendada! </h5>
<?php           }
?>
            </div>
            <div class="col-md-4 col-12 mt-3 mb-3">
                <h4 class="text-center"> Ultimas Consultas Agendadas </h4>
    
<?php           if($minhas_consultas) {
                    foreach($minhas_consultas as $ConAgen) {         ?>
                        <div class="card" style="col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h4 class="text-center"><?php echo $ConAgen["Especialidade"]; ?></h4>
                                    <h5 class="text-center"><?php echo $ConAgen["nome_pessoa"]; ?></h5>
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
<?php           }                                                       ?>
            </div>
<?php   }                                                                                                                   ?>
</div>

<!-- script local com funções específicas da tela -->
<script src="/app/geral/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>

<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>