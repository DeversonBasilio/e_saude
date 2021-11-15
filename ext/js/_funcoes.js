
function emailIsValid (email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

/// LOGIN
function Entrar() {

    var Email = $('#ipt_Email').val();  
    
    $.ajax({
        type : "POST",
        url :  "/app/register/_model.php",
        data : {'Email_entrar' : Email},
        success: function(data) {
            console.log(data);
            if(data == 'sucesso')
            {   
                window.location.href = '/app/geral/menu.php'
            }
            else if(data == 'error')
            {
                $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                        'Ocorreu um problema!' +
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                    '</div>');
            }
        }
    }); 
}

function Sair() {
    
    $.ajax({
        type : "POST",
        url :   "/app/geral/_model.php",
        data : {'Sair': true},
        success: function(data) {
            console.log(data);
            window.location.href = '/app/login/index.php'
        }
    });
}

function Trocar() {
    $.ajax({
        type : "POST",
        url :   "/app/geral/_model.php",
        data : {'Trocar': true},
        success: function(data) {
            console.log(data);
            location.reload();
        }
    });
}


/// BUSCA GERAL DE CEP
function Busca_cep(rua, bairro, cidade) {

    var CEP = $('#ipt_cep').val();

    CEP = CEP.replace(/\D/g, "")
    
    $("#mensagem").html('(Aguarde, consultando CEP ...)');
    
    $.getJSON("https://viacep.com.br/ws/"+ CEP +"/json/?callback=?", function(dados) {

        if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#"+rua).val(dados.logradouro);
            $("#"+bairro).val(dados.bairro);
            $("#"+cidade).val(dados.localidade);
        }
    });

    $("#mensagem").html('');
}