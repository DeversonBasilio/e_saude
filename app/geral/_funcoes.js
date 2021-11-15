function escolher_perfil(escolha) {

    $.ajax({
        type : "POST",
        url :   "/app/geral/_model.php",
        data : {'Perfil_escolhido': escolha},
        success: function(data) {
            if(escolha == 1)   {
                location.reload();
            }else{
                $('#div_conteudo').html(data);
            }
        }
    });
}

function    selecionar_ubs(escolha){
    $.ajax({
        type : "POST",
        url :   "/app/geral/_model.php",
        data : {'ubs_escolhida': escolha},
        success: function(data) {
                location.reload();
        }
    });
}

function Buscar_Ubs() {
    var TERMO_BUSCA = $('#termo').val();

    $.ajax({
        type : "POST",
        url :   "/app/geral/_model.php",
        data : {'TERMO_BUSCA': TERMO_BUSCA},
        success: function(data) {
            $('#conteudo_2').html(data);
        }
    });
}
