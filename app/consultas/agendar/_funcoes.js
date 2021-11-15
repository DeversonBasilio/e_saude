function Busca_ubs_cidade_Esp() {

var Esp_id = $("#sel_especialidades").children("option:selected").val();
var Cidade_id = $("#sel_cidades").children("option:selected").val();

if(Esp_id == -1) {
    $("#sel_especialidades").removeClass('is-valid');
    $("#sel_especialidades").addClass('is-invalid');

    $("#Step02-tab").removeClass('active');
    $("#Step02").removeClass('active show');

    $("#Step01-tab").addClass('active');
    $("#Step01").addClass('active show');
    return;
}

if(Cidade_id == -1) {
    $("#sel_cidades").removeClass('is-valid');
    $("#sel_cidades").addClass('is-invalid');

    $("#Step01-tab").removeClass('active');
    $("#Step01").removeClass('active show');

    $("#Step02-tab").addClass('active');
    $("#Step02").addClass('active show');
    return;
}

$.ajax({
    type : "POST",
    url :  "/app/consultas/agendar/_model.php",
    data : { 'ESP_ID'  : Esp_id, 'Cidade_id': Cidade_id },
    success: function(data) {                                
        $("#Ubs_esp").html(data);

        $("#Step01-tab").removeClass('active');
        $("#Step01").removeClass('active show');

        $("#Step02-tab").removeClass('active');
        $("#Step02").removeClass('active show');

        $("#Step03-tab").addClass('active');
        $("#Step03").addClass('active show');
    }
});
}

function Seleciona_ubs_consulta(Ubs_id) {

    var Esp_id = $('#sel_especialidades').children("option:selected").val();
    
    $.ajax({
        type : "POST",
        url :  "/app/consultas/agendar/_model.php",
        data : { 'Esp_id': Esp_id, 'UBS_ID': Ubs_id },
        success: function(data) {
            $('#Hour_div').html(data);
        }
    });
}

function Agendar_Consulta(UBS,ESP) {
var data_agenda = $('#Date_Select').val();
var hora_agenda = $('#Horario_Select').val();

$.ajax({
    type : "POST",
    url :  "/app/consultas/agendar/_model.php",
    data : { 'Especialidade_id': ESP, 'UBS_ID': UBS , 'DATA_AGENDA': data_agenda, 'HORA_AGENDA': hora_agenda },
    success: function(data) {
        console.log(data);
        location.reload();
    }
});
}