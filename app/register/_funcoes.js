function verifica_nome() {
    var Nome  = $('#ipt_nome_completo').val();
    var regex = /[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/;

    if(regex.test(Nome)) {
        $('#ipt_nome_completo').removeClass('is-invalid');
        $('#ipt_nome_completo').addClass('is-valid');
        return true;
    } else {
        $('#ipt_nome_completo').removeClass('is-valid');
        $('#ipt_nome_completo').addClass('is-invalid');        
        return false;
    }
}

function verifica_email_01() {
    var Email = $('#ipt_Email').val();    

    if (emailIsValid(Email)) {
        $('#ipt_Email').removeClass('is-invalid');
        $('#ipt_Email').addClass('is-valid');
        return true;
    } else {
        $('#ipt_Email').removeClass('is-valid');
        $('#ipt_Email').addClass('is-invalid');        
        return false;
    }
}

function verifica_email_02() {
    var Email_1 = $('#ipt_Email').val();  
    var Email_2 = $('#ipt_Email_conf').val();    
    var valido  = false;

    if (emailIsValid(Email_2)) {
        $('#ipt_Email_conf').removeClass('is-invalid');
        $('#ipt_Email_conf').addClass('is-valid');
        valido = true;
    } else {
        $('#ipt_Email_conf').removeClass('is-valid');
        $('#ipt_Email_conf').addClass('is-invalid');        
        valido = false;
    }
    
    if(Email_1 != Email_2) {
        $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'+
                                    'E-mail e confirmação </br> estão diferentes!'+
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                            '</div>');
        valido = false;
    } else {
        valido = true;
    }

    if (valido) {
        return true;
    } else {
        return false;
    }
}


function Enviar_Email_Registro() {

    var EMAIL = $('#ipt_Email').val();
    var NOME  = $('#ipt_nome_completo').val();
    
    $.ajax({
        type : "POST",
        url :  "/app/register/e_mail.php",
        data : { 'EMAIL_DEST': EMAIL , 'NOME_DEST' : NOME},
        success: function(data) {
            console.log(data);
        }
    });
}

function verifica_senha_1() {

    var password = $('#ipt_password').val();
    var regex = /.{8,}/;
    
    if (regex.test(password)) {
        $('#ipt_password').removeClass('is-invalid');
        $('#ipt_password').addClass('is-valid');
        return true;
    } else {
        $('#ipt_password').removeClass('is-valid');
        $('#ipt_password').addClass('is-invalid');        
        $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'+
                                'Mínimo de 8 caracteres!'+
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                            '</div>');
        return false;
    }
}

function verifica_senha_2() {
    var pass_1 = $('#ipt_password').val();  
    var pass_2 = $('#ipt_password_conf').val();    
    var valido  = false;
    var regex = /.{8,}/;

    if (regex.test(pass_2)) {
        $('#ipt_password_conf').removeClass('is-invalid');
        $('#ipt_password_conf').addClass('is-valid');
        valido = true;
    } else {
        $('#ipt_password_conf').removeClass('is-valid');
        $('#ipt_password_conf').addClass('is-invalid');      

        $('#div_error').html('  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'+
                                    'Mínimo de 8 caracteres!'+
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                '</div>');
        valido = false;
    }

    if(pass_1 != pass_2) {
        $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">Senha e confirmação </br> estão diferentes! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        valido = false;
    } else {
        valido = true;
    }

    if (valido) {
        return true;
    } else {
        return false;
    }
}

$('#ipt_nome_completo').focusout(function() {
    verifica_nome();
});

$('#ipt_Email').focusout(function() {
    verifica_email_01();
});

$('#ipt_Email_conf').focusout(function() {
    verifica_email_02();
});

$('#ipt_password').focusout(function() {
    verifica_senha_1();
});

$('#ipt_password_conf').focusout(function() {
    verifica_senha_2();
});

/// NOVO USUARIO
function Registrar() {
   
    var nome_com    = verifica_nome();
    var email_01    = verifica_email_01();
    var email_02    = verifica_email_02();
    var password    = verifica_senha_1();
    var password_2  = verifica_senha_2();
    
    if(nome_com && email_01 && email_02 && password && password_2) {

        
        var Nome    = $('#ipt_nome_completo').val();
        var Email   = $('#ipt_Email').val();  
        var pass    = $('#ipt_password').val();
        $.ajax({
            type : "POST",
            url :  "/app/register/_model.php",
            data : {'nome_comp': Nome , 'email_01': Email , 'password' : pass},
            success: function(data) {
                console.log(data);
                Enviar_Email_Registro();
                if(data == 'sucesso')
                {   
                    $('#div_error').html('  <div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                                'Usuário foi cadastrado!'+
                                                '<button type="button" class="btn" onclick="Entrar()"> Entrar</button>'+
                                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                            '</div>');
                }
                else if(data == 'error')
                {
                    $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">E-mail já existe! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            }
        });
    }
}