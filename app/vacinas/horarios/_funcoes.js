
function add_agenda() {

    var ubs_id       = $('#UBS_ID').val();;
    var PessoaID     = $('#PessoaID').val();;
    var procedimento = $('#sel_procedimentos').children("option:selected").val();
    var dataini = $('#ipt_DATAINI').val();
    var datafim = $('#ipt_DATAFIM').val(); 
    var horaini = $('#ipt_HORAINI').val();
    var horafim = $('#ipt_HORAFIM').val();
    var vagashora = $('#ipt_Vagas').val();

    $.ajax({
        type : "POST",
        url :  "/app/vacinas/horarios/_model.php",
        data : {'PessoaID'  :PessoaID,
                'UBS_id'    :ubs_id,
                'Proc_id'   :procedimento,
                'data_ini'  :dataini,
                'data_fim'  :datafim,
                'hora_ini'  :horaini,
                'hora_fim'  :horafim,
                'vagashora' :vagashora
        },
        success: function(data) {
            console.log(data);
            if(data == 'sucesso')   {   
                location.reload();
            } else {
                $('#div_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }
    });
}