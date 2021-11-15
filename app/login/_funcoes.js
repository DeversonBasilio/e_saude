
function verifica_emaillogin() {
    var Email = $('#ipt_Login').val();    

    if (emailIsValid(Email)) {
        $('#ipt_Login').removeClass('is-invalid');
        $('#ipt_Login').addClass('is-valid');
        return true;
    } else {
        $('#ipt_Login').removeClass('is-valid');
        $('#ipt_Login').addClass('is-invalid');        
        return false;
    }
}

function logar() {
    
    var login_email = $('#ipt_Login').val();
    var password    = $('#Input_Password').val();

    if(!verifica_emaillogin()) {
        return false;
    }
    
    $.ajax({
        type : "POST",
        url :  "/app/login/_model.php",
        data : {'login': login_email , 'password': password },
        success: function(data) {
            console.log(data);
            if(data == 'sucesso')   {  
                window.location.href = '/app/geral/menu.php';
            }
            else if(data == 'error')    {
                $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                            'E-mail e senha não encontrados! '+ 
                                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                     '</div>');
            }
        }
    });
}


$('#ipt_Login').focusout(function() {
    verifica_emaillogin();
});


function Esqueci_Minha_Senha() {    
    
    if(verifica_emaillogin()) {

        var EMAIL = $('#ipt_Login').val();
        
        $('#div_error').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">'+
                                'Enviamos um e-mail para a recuperação da senha!'+
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                             '</div>');

        $.ajax({
            type : "POST",
            url :  "/app/login/forgot_password/e_mail.php",
            data : { 'EMAIL_DEST': EMAIL},
            success: function(data) {
                console.log(data);
            }
        });
    }
}
