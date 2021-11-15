<?php   define('ACTIVE_PAGE', 'perfil');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/perfil/_load.php');  ?>

    <h4 class="text-center"> Perfil </h4 class="text-center">
    
    <h6> Dados Basícos </h6>
    <hr>

    <div id="dados_basicos">
            
        <div class="row">
            <div class="form-floating mb-3">
                <input type="text"   name="Nome" class="form-control text-center" id="ipt_nome" placeholder="Nome" value="<?php echo $Persons["PersonNome"]?>">
                <label for="ipt_nome">Nome completo</label>
            </div>
        <div>
            
        <div class="row">
            <div class="form-floating mb-3 col">
                <input type="date"   name="Data_Nascimento" class="form-control text-center" id="ipt_dtnasc" placeholder="Data_Nascimento" value="<?php echo $Persons["PersonData_Nascimento"]?>">
                <label for="ipt_dtnasc">Nascimento</label>
            </div>

            <div class="form-floating mb-3 col">
                <select name="Tipo_Sangue" class="form-control text-center" id="sel_Sangue" placeholder="Tipo Sanguíneo">
                    <option value="NA"  <?php echo (!isset($Persons["PersonTipo_Sangue"])? "selected" : " "); ?> >Selecione</option>
                    <option value="UNK"  <?php echo ($Persons["PersonTipo_Sangue"] == "UNK" ? "selected" : " "); ?>>Não Sei</option>
                    <option value="A+"   <?php echo ($Persons["PersonTipo_Sangue"] == "A+" ? "selected" : " "); ?>> A+</option>
                    <option value="A-"   <?php echo ($Persons["PersonTipo_Sangue"] == "A-" ? "selected" : " "); ?>> A-</option>
                    <option value="B+"   <?php echo ($Persons["PersonTipo_Sangue"] == "B+" ? "selected" : " "); ?>> B+</option>
                    <option value="B-"   <?php echo ($Persons["PersonTipo_Sangue"] == "B-" ? "selected" : " "); ?>> B-</option>
                    <option value="AB+"  <?php echo ($Persons["PersonTipo_Sangue"] == "AB+" ? "selected" : " "); ?>>AB+</option>
                    <option value="AB-"  <?php echo ($Persons["PersonTipo_Sangue"] == "AB-" ? "selected" : " "); ?>>AB-</option>
                    <option value="O+"   <?php echo ($Persons["PersonTipo_Sangue"] == "O+" ? "selected" : " "); ?>> O+</option>
                    <option value="O-"   <?php echo ($Persons["PersonTipo_Sangue"] == "O-" ? "selected" : " "); ?>> O-</option>
                </select>
                <label for="sel_Sangue">Sangue</label>
            </div>
        </div>

        <div class="row">
            <div class="form-floating mb-3 col">                
                <select name="Cor" class="form-control text-center" id="sel_cor">  <?php 
                    foreach($Cores as $Cor){  ?>  
                            <option value="<?php echo $Cor["CorID"]; ?>" 
                                <?php echo ($Persons["PersonCor_Id"] == $Cor["CorID"] ? "selected" : " " ) ?>>   <?php echo $Cor["CorDesc"];?>  </option> 
                    <?php   }                           ?>
                </select>
                <label for="sel_cor">Cor</label>
            </div>

            <div class="form-floating mb-3 col">                
                <select name="sexo" class="form-control text-center" id="sel_sexo">  <?php 
                    foreach($sexos as $sexo){  ?>  
                            <option value="<?php echo $sexo["sexoId"]; ?>" 
                                <?php echo ($Persons["PersonSexo_Id"] == $sexo["sexoId"] ? "selected" : " " ) ?>>   <?php echo $sexo["sexoDesc"];?>  </option> 
                    <?php   }                           ?>
                </select>
                <label for="sel_sexo">Sexo</label>
            </div>
        </div>
    </div>

    <div id="documentos">
        
        <h6 class="mt-2"> Documentos </h6>
        <hr>

        <div class="row">
            <div class="form-floating mb-3">
                <input type="hidden" name="PersonID" id="PersonID" value="<?php echo $Persons["PersonId"]?>"/>
                <input type="text"   name="CPF" class="form-control text-center" id="ipt_CPF" placeholder="CPF" value="<?php echo $Persons["PersonCPF"]?>">
                <label for="ipt_CPF">CPF</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text"   name="RG" class="form-control text-center" id="ipt_RG" placeholder="RG" value="<?php echo $Persons["PersonRG"]?>">
                <label for="ipt_RG">RG</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text"   name="CNS" class="form-control text-center" id="ipt_CNS" placeholder="CNS" value="<?php echo $Persons["PersonCNS"]?>">
                <label for="ipt_CNS">CNS (Cartão Nacional de Saúde)</label>
            </div>
        </div>
        
    </div>

    <div id="contato" class="row">
        
        <h6 class="mt-2"> Contato </h6>
        <hr>
        
        <div class="form-floating mb-3 col-12 col-sm-4">
            <input type="text"   name="celular" class="form-control text-center" id="ipt_celular" placeholder="celular" value="<?php echo $Persons["Personcelular"]?>" > 
            <label for="ipt_celular">Celular</label>
        </div>

        <div class="form-floating mb-3 col-12 col-sm-4">
            <input type="text"   name="Telefone" class="form-control text-center" id="ipt_telefone" placeholder="Telefone" value="<?php echo $Persons["PersonTelefone"]?>">
            <label for="ipt_telefone">Telefone</label>
        </div>

        <div class="form-floating mb-3 col-12 col-sm-4">
            <input type="text"   name="Telefone_2" class="form-control text-center" id="ipt_telefone2" placeholder="Telefone_2" value="<?php echo $Persons["PersonTelefone_2"]?>">
            <label for="ipt_telefone2">Telefone 2</label>
        </div>
    </div>

    <div id="endereço">
        
        <h6 class="mt-2"> Endereço </h6>
        <hr>

        <div class="row" id="mensagem"></div>
        <div class="form-floating mb-3 input-group">
            <input type="text"   name="CEP" class="form-control text-center" id="ipt_cep" placeholder="CEP" value="<?php echo $Persons["PersonCEP"]?>">
            <label for="ipt_cep">CEP</label>
            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="Busca_cep('ipt_rua','ipt_bairro','ipt_cidade')">Buscar</button>
        </div>

        <div class="form-floating mb-3">
            <input type="text"   name="Rua" class="form-control text-center" id="ipt_rua" placeholder="Rua" value="<?php echo $Persons["PersonRua"]?>">
            <label for="ipt_rua">Rua</label>
        </div>

        <div class="row">
            <div class="form-floating mb-3 col-3">
                <input type="text"   name="Numero" class="form-control text-center" id="ipt_numero" placeholder="Numero" value="<?php echo $Persons["PersonNumero"]?>">
                <label for="ipt_numero">Numero</label>
            </div>

            <div class="form-floating mb-3 col-9">
                <input type="text"   name="Bairro" class="form-control text-center" id="ipt_bairro" placeholder="Bairro" value="<?php echo $Persons["PersonBairro"]?>">
                <label for="ipt_bairro">Bairro</label>
            </div>
        </div>
        
        <div class="form-floating mb-3">
            <input type="text"   name="complemento" class="form-control text-center" id="ipt_complemento" placeholder="complemento" value="<?php echo $Persons["PersonComplemento"]?>">
            <label for="ipt_complemento">complemento</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text"   name="Cidade" class="form-control text-center" id="ipt_cidade" placeholder="Cidade" value="<?php echo $Persons["PersonCidade"]?>">
            <label for="ipt_cidade">Cidade</label>
        </div>
    </div>

    <hr>

    <div class="row">   
        <button type="button" class="btn btn-success col-12 mb-3 ms-2" onclick="salvar_perfil()">
            SALVAR
        </button>
    </div>

<!-- script local com funções específicas da tela -->
<script src="/app/perfil/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>