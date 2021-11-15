<?php   define('ACTIVE_PAGE', 'cardeneta');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/vacinas/cardeneta/_load.php');  ?>

<h4 class="text-center"> Minhas Vacinas </h4 class="text-center">
<hr/>

<div class="row">
    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Covid</th></tr>
            </thead>
            <tbody>
        <?php   
                $Covid = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 11) {
                        $Covid = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Covid == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>


    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Gripe</th></tr>
            </thead>
            <tbody>
        <?php   
                $Gripe = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 39) {
                        $Gripe = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Gripe == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>

    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Febre Amarela</th></tr>
            </thead>
            <tbody>
        <?php   
                $FebreAmarela = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 30) {
                        $FebreAmarela = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($FebreAmarela == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <!-- VACINA DE PÓLIO -->
    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Pólio</th></tr>
            </thead>
            <tbody>
        <?php   
                $Polio = 0;
                foreach($vacinas as $vac ) {        
                    if($vac["Proc_id"] == 33) {
                        $Polio = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Polio == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>

    <!-- VACINA DE Tríplice -->
    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Tríplice</th></tr>
            </thead>
            <tbody>
        <?php   
                $Trip = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 34) {
                        $Trip = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Trip == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>


    <!-- VACINA DE Sarampo -->

    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Sarampo</th></tr>
            </thead>
            <tbody>
        <?php   
                $Sarampo = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 38) {
                        $Sarampo = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Sarampo == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Rotavírus</th></tr>
            </thead>
            <tbody>
        <?php   
                $Rotavirus = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 23) {
                        $Rotavirus = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Rotavirus == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>


    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Hepatite B</th></tr>
            </thead>
            <tbody>
        <?php   
                $Hepatite = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 15) {
                        $Hepatite = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Hepatite == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>

    <div class="col-12 col-md-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr><th colspan=2>Miníngococo</th></tr>
            </thead>
            <tbody>
        <?php   
                $Miningococo = 0;
                foreach($vacinas as $vac ) {            
                    if($vac["Proc_id"] == 19) {
                        $Miningococo = 1;
        ?>
                        <tr>
                            <td><?php echo $vac["Proc_data"]; ?></td>
                            <td><?php echo $vac["Proc_dose"]; ?></td>
                        </tr>
        <?php
                    }
                }

                if($Miningococo == 0) {   ?>  <tr> <td colspan=2> Vacinas não encontrada!</td></tr> <?php }   ?>
            </tbody>
        </table>
    </div>
</div>

<!-- script local com funções específicas da tela -->
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>