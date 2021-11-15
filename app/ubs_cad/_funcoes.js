/// CADASTRO DE UNIDADE DE SAUDE
function Salva_US()
{
    var UBSID   = $('#ipt_UBS_ID').val();
    var CNES    = $('#ipt_CNES').val();
    var NOME    = $('#ipt_nom_estab').val();
    var TEL     = $('#ipt_dsc_telefone').val();
    var CEP     = $('#ipt_cep').val();
    var Rua     = $('#ipt_dsc_endereco').val();
    var NUM     = $('#ipt_end_num').val();
    var Bairro  = $('#ipt_dsc_bairro').val();
    var Cidade  = $('#ipt_cidade').val();

    $.ajax({
        type : "POST",
        url :  "/app/ubs_cad/_model.php",
        data : {'UBS_ID'  :UBSID,
                'CNES'    :CNES,
                'NOME'    :NOME,
                'TEL'     :TEL,
                'CEP'     :CEP,
                'Rua'     :Rua,
                'NUM'     :NUM, 
                'Bairro'  :Bairro,
                'Cidade'  :Cidade
        },
        success: function(data) {
            console.log(data);
            if(data == 'sucesso')
            {   
                $('#div_error').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Cadastro Salvo! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }
    });
}