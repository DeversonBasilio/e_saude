

function aplica_mascara_cpf() {

    var CPF = $('#ipt_CPF').val();
    CPF = CPF.replace(/\D/g, "");
    
    if(CPF) CPF = CPF.match(/.{1,3}/g).join(".").replace(/\.(?=[^.]*$)/,"-");
    $('#ipt_CPF').val(CPF);
}

function aplica_mascara_rg() {

    var RG = $('#ipt_RG').val();

    RG = RG.replace(/\D/g,"");
    RG = RG.replace(/(\d{2})(\d{3})(\d{3})(\d{1})$/,"$1.$2.$3-$4");
      
    $('#ipt_RG').val(RG);
}

function aplica_mascara(campo) {
    var telefone = $('#'+campo).val();
    
    telefone = telefone.replace(/\D/g,"");

    r = telefone.replace(/^0/, "");
    if (r.length > 10) {
      r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
      r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
      r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      r = r.replace(/^(\d*)/, "($1");
    }

    $('#'+campo).val(r);
}

$('#ipt_CPF').focusout(function(){
    aplica_mascara_cpf();
 });

 $('#ipt_RG').focusout(function(){
    aplica_mascara_rg();
 });

 $('#ipt_celular').focusout(function(){
    aplica_mascara('ipt_celular');
 });

 $('#ipt_telefone').focusout(function(){
    aplica_mascara('ipt_telefone');
 });

 $('#ipt_telefone2').focusout(function(){
    aplica_mascara('ipt_telefone2');
 });

 
function salvar_perfil() {

    
    var PessoaID    = $('#PersonID').val();
    var Nome        = $('#ipt_nome').val();
    var DataNasc    = $('#ipt_dtnasc').val();
    var sel_sangue  = $('#sel_Sangue').children("option:selected").val();
    var Cor_id      = $('#sel_cor').children("option:selected").val();
    var Sexo_id     = $('#sel_sexo').children("option:selected").val();
    var CPF         = $('#ipt_CPF').val();
    var RG          = $('#ipt_RG').val();
    var CNS         = $('#ipt_CNS').val();
    var celular     = $('#ipt_celular').val();
    var telefone    = $('#ipt_telefone').val();
    var Telefone_2  = $('#ipt_telefone2').val();
    var CEP         = $('#ipt_cep').val();
    var Rua         = $('#ipt_rua').val();
    var Numero      = $('#ipt_numero').val();
    var Bairro      = $('#ipt_bairro').val();
    var Complemento = $('#ipt_complemento').val();
    var Cidade      = $('#ipt_cidade').val();
    
    $.ajax({
        type : "POST",
        url :  "/app/perfil/_model.php",
        data : {'PersonID'  :PessoaID,
                'Nome'      :Nome,
                'Data_Nascimento': DataNasc,
                'Tipo_Sangue': sel_sangue,
                'Cor' : Cor_id,
                'sexo': Sexo_id,
                'CPF' : CPF,
                'RG'  : RG,
                'CNS' : CNS,
                'celular': celular,
                'Telefone': telefone,
                'Telefone_2': Telefone_2,
                'CEP':  CEP,
                'Rua': Rua,
                'Numero': Numero, 
                'Bairro': Bairro,
                'Complemento': Complemento,
                'Cidade': Cidade
        },
        success: function(data) {
            console.log(data);
            if(data == 'sucesso')
            {   
                $('#div_error').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Cadastro Salvo! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }        
    });
}

 