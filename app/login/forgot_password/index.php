<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/login/forgot_password/_load.php'); ?>

<div class="row justify-content-md-center">
    <div class="col-12 col-lg-4 d-flex flex-column min-vh-100 justify-content-center align-items-center" >

        <div class="card">
            <img src="/ext/images/e_saudebr.svg" class="img-fluid" alt="...">                    
            
            <div id="div_error"></div>
            
            <div class="card-body">
                <div class="form-floating row-fluid mb-2">
                    <h3><?php echo $Persons["Personnome"] ?></h3>
                    </br>
                    <h2><?php echo $Persons["Personemail"] ?></h2>
                    <input type="hidden" name="uid" id="ipt_uid" value="<?php echo $Persons["PersonId"] ?>" />
                    <input type="hidden" name="email" id="ipt_Email" value="<?php echo $Persons["Personemail"] ?>" />
                </div>
                
                <div class="form-floating row-fluid mb-2">
                    <input type="password" name="password" class="form-control text-center" id="ipt_password"  placeholder="Senha"/>
                    <label for="ipt_password">Nova Senha</label>
                </div>

                <div class="form-floating row-fluid mb-2">
                    <input type="password" name="password" class="form-control text-center" id="ipt_password_conf"  placeholder="Confirmação de Senha"/>
                    <label for="ipt_password_conf">Confirmação de Senha</label>
                </div>
                
                <div class="form-floating row-fluid mb-2">
                    <button type="button" class="btn btn-success col-12" onclick="Recuperar_Senha()">  
                        Salvar nova senha
                    </button>
                </div> 
            </div>
        </div>
                    
    </div>
</div>

<!-- script local com funções específicas da tela -->
<script src="/app/login/forgot_password/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>

<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>