
function Recuperar_Senha() {
   
    var uid     = $('#ipt_uid').val();
    var pach    = $('#ipt_password').val();
    var Email   = $('#ipt_Email').val();
    var pachword_conf = $('#ipt_password_conf').val();  

    if(pachword_conf == pach)
    {    
        $.ajax({
            type : "POST",
            url :  "/app/login/forgot_password/_model.php",
            data : {'pach': pach , 'email_01': Email , 'uid' : uid},
            
            success: function(data) {
                console.log(data);
                if(data == 'sucesso')
                {   
                    Entrar();
                }
            }
        });
    } else {
        $('#div_error').html('<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">'+
            'Senha e Confirmação precisam ser iguais, mas estão diferentes!'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
        '</div>');
    }
}