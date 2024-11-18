function search(){
    select = $(`#colaborador`)
    selectedElement = select.val()
    $.ajax({
        url: 'others/busca_colaborador.php',
        method: 'GET',
        success: function(response){
            select.empty();
            var array = JSON.parse(response);
            select.append(`<option name="selecione" value="selecione" selected>SELECIONE</option>`);
                    array.forEach(function(m){
                        select.append(`<option name="${m.nome}_colaborador" value="${m.nome}">${m.nome}</option>`);
                    })
                    console.log(selectedElement)
            select.val(selectedElement);
        },
        error: function(){
          select.append(`Erro na busca`);
        }
    });
}