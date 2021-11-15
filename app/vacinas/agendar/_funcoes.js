function Busca_ubs_cidade() {

    var ID_Cidade = $('#sel_cidades').children("option:selected").val();

    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendar/_model.php",
        data : { 'ID_CIDADE_BUSCADA': ID_Cidade },
        success: function(data) {
            $('#ubs_div').html(data);
        }
    });
}


function Deleta_Agenda(Agenda_ID) {
    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendar/_model.php",
        data : { 'DEL_AG_ID': Agenda_ID },
        success: function(data) {
            console.log(data);
            if(data == 'sucesso')   {   
                location.reload();
            } else {
                $('#div_result').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }
    });
}

function Seleciona_ubs(Ubs_id) {
    var proc_id = $('#sel_procedimentos').children("option:selected").val();

    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendar/_model.php",
        data : { 'PROC_ID': proc_id, 'UBS_ID': Ubs_id },
        success: function(data) {
            $('#Hour_div').html(data);
        }
    });
}


function Agendar_Horario(UBS_ID,PROC_ID) {

    var Data_sel = $('#Date_Select').val();
    var Hora_sel = $('#Horario_Select').val();

    if(Data_sel.length === 0) {
        $('#div_erro_agenda').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Selecione uma data válida!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>')
    }
    else {
        $.ajax({
            type : "POST",
            url :  "/app/vacinas/agendar/_model.php",
            data : { 'PROC_ID': PROC_ID, 'UBS_ID': UBS_ID , 'DATA_HORA': Data_sel, 'HORA_SEL': Hora_sel},
            success: function(data) {                                
                console.log(data);
                location.reload();
            }
        });
    }
}