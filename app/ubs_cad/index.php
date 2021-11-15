<?php   define('ACTIVE_PAGE', 'perfil');   ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_header.html'); ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_navbar.php');  ?>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/app/ubs_cad/_load.php');  ?>

<h4 class="text-center"> Unidade de Saúde</h4 class="text-center">
    
<div class="container">
        
    <div class="row">
        <div class="form-floating mb-3">
            <input type="hidden" id="ipt_UBS_ID" value="<?php echo $UBS["UBS_ID"]; ?>" />
            <input type="text"   name="CNES" class="form-control text-center" id="ipt_CNES" placeholder="CNES" value="<?php echo $UBS["cod_cnes"]?>">
            <label for="ipt_nome">CNES</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text"   name="nom_estab" class="form-control text-center" id="ipt_nom_estab" placeholder="Nome Estalecimento" value="<?php echo $UBS["nom_estab"]?>">
            <label for="ipt_nom_estab">Nome unidade</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text"   name="telefone" class="form-control text-center" id="ipt_dsc_telefone" placeholder="telefone" value="<?php echo $UBS["dsc_telefone"]?>">
            <label for="ipt_dsc_telefone">Telefone</label>
        </div>
    <div>

    <div class="div_error"></div>
    <div id="endereço">
        <h6 class="mt-2"> Endereço </h6>
        <hr>

        <div id="mensagem"></div>
        <div class="row">
            <div class="form-floating mb-3 input-group">
                <input type="text"   name="CEP" class="form-control text-center" id="ipt_cep" placeholder="CEP" value="<?php echo $UBS["CEP"]?>">
                <label for="ipt_cep">CEP</label>
                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="Busca_cep('ipt_dsc_endereco','ipt_dsc_bairro','ipt_cidade')">Buscar</button>
            </div>
        </div>

        <div class="row">
            <div class="form-floating mb-3">
                <input type="text"   name="rua" class="form-control text-center" id="ipt_dsc_endereco" placeholder="Rua" value="<?php echo $UBS["dsc_endereco"]?>">
                <label for="ipt_dsc_endereco">Rua</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text"   name="rua" class="form-control text-center" id="ipt_end_num" placeholder="Numero" value="<?php echo $UBS["end_num"]?>">
                <label for="ipt_end_num">Número</label>
            </div>
        </div>

        <div class="row">
            <div class="form-floating mb-3">
                <input type="text"   name="Bairro" class="form-control text-center" id="ipt_dsc_bairro" placeholder="Bairro" value="<?php echo $UBS["dsc_bairro"]?>">
                <label for="ipt_dsc_bairro">Bairro</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text"   name="Cidade" class="form-control text-center" id="ipt_cidade" placeholder="Cidade" value="<?php echo $UBS["dsc_cidade"]?>">
                <label for="ipt_cidade">Cidade</label>
            </div>
        </div>
    </div>

    <div class="row">
        <button class="btn btn-lg btn-success col-3" onclick="Salva_US()">
            Salvar
        </button>
    </div>        
</div>
<!-- script local com funções específicas da tela -->
<script src="/app/ubs_cad/_funcoes.js"  type="text/javascript"   crossorigin="anonymous"></script>
<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/templates/_footer.html'); ?>