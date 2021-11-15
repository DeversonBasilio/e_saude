<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>

<div class="row justify-content-md-center">
    <div class="col-12 col-lg-4 d-flex flex-column min-vh-100 justify-content-center align-items-center" >

        <div class="card">
            <img src="/ext/images/e_saudebr.svg" class="img-fluid" alt="...">                    
            
            <div id="div_error"></div>

            <div class="card-body">
                <div class="form-floating row-fluid mb-2">
                    <input type="email" name="login" class="form-control text-center" id="ipt_Login" placeholder="name@example.com">
                    <label for="ipt_Login">E-mail</label>
                </div>

                <div class="form-floating row-fluid mb-2">
                    <input type="password" name="password" class="form-control text-center" id="Input_Password" placeholder="password">
                    <label for="Input_Password">Password</label>
                </div>

                <div class="form-floating row-fluid mb-2">
                    <button type="button" class="btn col-12" style="background-color:#046c43;color:whitesmoke" onclick="logar()">  
                        Logar
                    </button>
                </div> 
                <div class="form-floating row-fluid mb-2">
                    <a href="/app/register/index.php" class="btn col-12" style="background-color:#04549c;color:whitesmoke">
                        Registrar
                    </a>
                </div>
                <div class="form-floating row-fluid mb-2">
                    <button type="button" class="btn col-12" style="background-color:#fbbb04;color:whitesmoke" onclick="Esqueci_Minha_Senha()">  
                        Esqueci minha Senha
                    </button>
                </div> 
            </div>
        </div>
                           
    </div>
</div>


<!-- script local com funções específicas da tela -->
<script src="/app/login/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>

<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>