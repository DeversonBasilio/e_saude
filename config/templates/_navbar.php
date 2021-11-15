<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php');             
    
    function active_page($name_page) 
    {   
        if(ACTIVE_PAGE == $name_page) {
            echo 'active';
        }
    }
?>
<header>
    <div class="navbar-header">
        <div class="row justify-content-center">
            <img src="/ext/images/e_saudebr.svg" class="img-fluid navbar-brand col-7" alt="..." /> 
            <h1 class="display-6 text-center"><?php echo $_SESSION['USUARIOS']["Nome"]; ?></h1>               
        </div>
    </div>
</header>
<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
    <div class="container">
        <div class="d-flex">
            <a href="/app/geral/menu.php" class="btn <?php active_page('menu') ?>">Home</a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">

<?php       if(isset($_SESSION["UBS"]) && $_SESSION["UBS"] == 0) {              ?>


                <ul class="navbar-nav w-100 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link <?php active_page('perfil') ?>" href="/app/perfil/index.php">Meus Dados</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Vacinas </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item <?php active_page('vacinas_agendar') ?>" href="/app/vacinas/agendar/index.php">Agendamento</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item <?php active_page('cardeneta') ?>"       href="/app/vacinas/cardeneta/index.php">Minhas Vacinas</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Consultas </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item <?php active_page('consultas_agendar') ?>" href="/app/consultas/agendar/index.php">Agendamento</a></li>
                        </ul>
                    </li>

                </ul>  

                
<?php       } elseif (isset($_SESSION["UBS"]) && $_SESSION["UBS"] > 0) {       ?>



                <ul class="navbar-nav w-100 justify-content-center">
                    <li><a class="dropdown-item <?php active_page('ubs_cad') ?>" href="/app/ubs_cad/index.php">Dados UBS</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Vacinas </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item <?php active_page('vacinas_horarios') ?>"    href="/app/vacinas/horarios/index.php">Criar Agendas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item <?php active_page('vacina_agendados') ?>"   href="/app/vacinas/agendados/index.php">Agendados</a></li>                           
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Consultas </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item <?php active_page('consultas_horarios') ?>"    href="/app/consultas/Especialidades/index.php">Especialidades</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item <?php active_page('consultas_agendados') ?>"   href="/app/consultas/agendados/index.php">Agendados</a></li>                           
                        </ul>
                    </li>
                </ul>



<?php       } elseif (isset($_SESSION["UBS"]) && $_SESSION["UBS"] == -1) {      ?>

    
                <ul class="navbar-nav w-100 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" onclick="escolher_perfil(1)">Pessoal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="escolher_perfil(2)">Profissional</a>
                    </li>
                </ul>


<?php       }                                                                   ?>            
        </div>

        <div class="d-flex">
<?php       if($_SESSION["UBS"] > 0) {                                    ?>
                    <button type="button" class=" btn btn-warning"  onclick="Trocar()">Trocar</button>
<?php       }                                                          ?>
            <button type="button" class=" btn btn-danger"  onclick="Sair()">Sair</button>
        </div>
    </div>
</nav>