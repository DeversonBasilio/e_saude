function Busca_Agendados() {
    
    var procedimento = $('#sel_procedimentos').children("option:selected").val();
    var data_agenda  = $('#data_sel').val();

    if(procedimento > 0) {
        $.ajax({
            type : "POST",
            url :  "/app/vacinas/agendados/_model.php",
            data : { 'PROC_ID': procedimento , 'Data_Agenda' : data_agenda},
            success: function(data) {
                $('#div_result').html(data);
            }
        });
    } else {
        $('#sel_procedimentos').focus();
    }
}

$(document).ready(function() {
    var optional_config = {
        inline: true,
        onChange: function(selectedDates, dateStr, instance) {
            selectedDates.forEach(function (date){
                $("#data_sel").val(date.getFullYear()+'-'+(date.getMonth() + 1) +'-'+date.getDate());
                Busca_Agendados();
            })
        }
    }
    $("#div_result").flatpickr(optional_config);
});


/// ATENDIMENTO DE PACIENTE 
function Atender_Paciente(ID_AGENDA) {
    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendados/_model.php",
        data : { 'ID_AGENDA' : ID_AGENDA},
        success: function(data) {
            $('#div_result').html(data);
        }
    });
}


function Salva_Info_Basicas() {

    var NOME =  $('#ipt_nome').val();
    var NASC =  $('#ipt_dtnasc').val();
    var SANG =  $('#sel_Sangue').children("option:selected").val();
    var Cor  = $('#sel_cor').children("option:selected").val();
    var Sexo = $('#sel_sexo').children("option:selected").val();
    var PESSOA_ID = $('#ipt_Pessoa_ID').val();
    var ID_AGENDA =  $('#ipt_ID_AGENDA').val();

    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendados/_model.php",
        data : { 'ID_AGENDA' : ID_AGENDA , 'NOME' : NOME, 'NASC': NASC, 'SANG' : SANG, 'COR' : Cor, 'Sexo': Sexo, 'PessoaID': PESSOA_ID},
        success: function(data) {
            console.log(data);
            Atender_Paciente(ID_AGENDA)
        }
    });
}

function Adicionar_Vacina() {

    var proc        = $('#sel_proc').children("option:selected").val();
    var dose        = $('#sel_dose').children("option:selected").val();
    var dt_vacina   = $('#dt_vacina').val();  
    var ID_AGENDA   = $('#ipt_ID_AGENDA').val();
    var PESSOA_ID   = $('#ipt_Pessoa_ID').val();
    
    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendados/_model.php",
        data : { 'ID_AGENDA' : ID_AGENDA ,'PessoaID': PESSOA_ID , 'VACINA' : proc, 'dose' : dose, 'DATA_VAC' : dt_vacina},
        success: function(data) {
            Atender_Paciente(ID_AGENDA)
        }
    });
}

function Excluir_Vacina(ID_CARTEIRA) {
    
    var ID_AGENDA   = $('#ipt_ID_AGENDA').val();

    $.ajax({
        type : "POST",
        url :  "/app/vacinas/agendados/_model.php",
        data : { 'ID_AGENDA' : ID_AGENDA , 'ID_CARTEIRA' : ID_CARTEIRA},
        success: function(data) {
            console.log(data);
            Atender_Paciente(ID_AGENDA)
        }
    });
}
