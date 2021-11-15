function switch_especialidade(Esp,Ativo) {
    $.ajax({
        type : "POST",
        url :  "/app/consultas/especialidades/_model.php",
        data : { 'ESP': Esp, 'Ativo':Ativo},
        success: function(data) {                                
            console.log(data);
            location.reload();
        }
    });
}