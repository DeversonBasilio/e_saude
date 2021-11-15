<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>

<div class="row justify-content-md-center">
    <div class="col-12 col-lg-4 d-flex flex-column min-vh-100 justify-content-center align-items-center" >

        <div class="card">
            <img src="/ext/images/e_saudebr.svg" class="img-fluid" alt="...">                    
                    
            <div id="div_error"></div>
                    
            <div class="card-body">

                <div class="form-floating row-fluid mb-2">
                    <input type="text"  name="nome_completo" class="form-control text-center" id="ipt_nome_completo" placeholder="Nome Completo"/>
                    <label for="ipt_nome_completo">Nome completo</label>
                </div>

                <div class="form-floating row-fluid mb-2">
                    <input type="email" name="Email1" class="form-control text-center" id="ipt_Email" placeholder="name@example.com"/>
                    <label for="ipt_Email">E-mail</label>
                </div>
                        
                <div class="form-floating row-fluid mb-2">
                    <input type="email" name="Email_conf" class="form-control text-center" id="ipt_Email_conf" placeholder="name@example.com"/>
                    <label for="ipt_Email_conf">Confirmação de e-mail</label>
                </div>

                <div class="form-floating row-fluid mb-2">
                    <input type="password" name="password" class="form-control text-center" id="ipt_password"  placeholder="Senha"/>
                    <label for="ipt_password">Senha</label>
                </div>

                <div class="form-floating row-fluid mb-2">
                    <input type="password" name="password" class="form-control text-center" id="ipt_password_conf"  placeholder="Confirmação de Senha"/>
                    <label for="ipt_password_conf">Confirmação de Senha</label>
                </div>
                
                <div class="form-floating row-fluid mb-2">
                    <button type="button" class="btn btn-success col-12" onclick="Registrar()">  
                        Registrar
                    </button>
                </div> 
                <div class="form-floating row-fluid mb-2">
                    <a href="/app/login/index.php" class="btn btn-primary col-12">
                        Logar
                    </a>
                </div>

            </div>
        </div>
                           
    </div>
</div>

<!-- script local com funções específicas da tela -->
<script src="/app/register/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>

<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>