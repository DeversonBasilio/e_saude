function Busca_Agendados() {
    
    var Especialidade = $('#sel_especialidade').children("option:selected").val();
    var data_agenda   = $('#data_sel').val();

    if(Especialidade > 0) {
        $.ajax({
            type : "POST",
            url :  "/app/consultas/agendados/_model.php",
            data : { 'ESP_ID': Especialidade , 'Data_Agenda' : data_agenda},
            success: function(data) {
                $('#div_result').html(data);
            }
        });
    } else {
        $('#sel_especialidade').focus();
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
