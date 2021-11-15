function add_hour_esp() {
            
    var dt_data_ini = $("#dt_data_ini").val();
    var dt_data_fim = $("#dt_data_fim").val();
    var hora_ini    = $("#hora_ini").val();
    var hora_fim    = $("#hora_fim").val();

    if($.trim(dt_data_ini) == '') {
        $('#dt_data_ini').addClass('is-invalid');
        $('#dt_data_ini').removeClass('is-valid');
        return;
    } else {
        $('#dt_data_ini').removeClass('is-invalid');
        $('#dt_data_ini').addClass('is-valid');
    }

    if($.trim(dt_data_fim) == '') {
        $('#dt_data_fim').addClass('is-invalid');
        $('#dt_data_fim').removeClass('is-valid');
        return;
    } else {
        $('#dt_data_fim').removeClass('is-invalid');
        $('#dt_data_fim').addClass('is-valid');
    }

    if($.trim(hora_ini) == '') {
        $('#hora_ini').addClass('is-invalid');
        $('#hora_ini').removeClass('is-valid');
        return;
    } else {
        $('#hora_ini').removeClass('is-invalid');
        $('#hora_ini').addClass('is-valid');
    }

    if($.trim(hora_fim) == '') {
        $('#hora_fim').addClass('is-invalid');
        $('#hora_fim').removeClass('is-valid');
        return;
    } else {
        $('#hora_fim').removeClass('is-invalid');
        $('#hora_fim').addClass('is-valid');
    }
 
    var check_seg   = $("#check_seg").is(":checked");
    var check_ter   = $("#check_ter").is(":checked");
    var check_qua   = $("#check_qua").is(":checked");
    var check_quin  = $("#check_quin").is(":checked");
    var check_sex   = $("#check_sex").is(":checked");
    var check_sab   = $("#check_sab").is(":checked");
    var check_dom   = $("#check_dom").is(":checked");

    var Esp_id      = $("#Esp_id").val();

    $.ajax({
        type : "POST",
        url :  "/app/consultas/horarios/_model.php",
        data : { 
            'ESP_ID'  : Esp_id,
            'DATA_INI': dt_data_ini, 
            'DATA_FIM': dt_data_fim,
            'HORA_INI': hora_ini,
            'HORA_FIM': hora_fim,
            'SEG':check_seg,
            'TER':check_ter,
            'QUA':check_qua,
            'QUI':check_quin,
            'SEX':check_sex,
            'SAB':check_sab,
            'DOM':check_dom
        },
        success: function(data) {                                
            console.log(data);
            location.reload();
        }
    });
}

function Excluir_Horario(UCH_ID) {

    $.ajax({
        type : "POST",
        url :  "/app/consultas/horarios/_model.php",
        data : { 
            'UCH_ID'  : UCH_ID
        },
        success: function(data) {                                
            console.log(data);
            location.reload();
        }
    });
}