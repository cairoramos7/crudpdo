/**
 * Created by cairo on 03/05/2017.
 */
$(document).on("click", "#delete", function(e) {
    var uri = $(this).data("uri"); // "get" the intended link in a var
    var method = $(this).data("method"); // "get" the intended link in a var
    var dataDrop = $(this).data("drop"); // "get" the intended link in a var
    e.preventDefault();
    bootbox.confirm("Tem Certeza Que Deseja Apagar?", function(result) {
        if (result) {
            $.ajax({
                method: "POST",
                url: "requests.php",
                data: {
                    chave: dataDrop,
                    modo: 'apagar'
                }
            }).done(function (msg) {
                window.open('/', '_parent');
            });
        }
    });
});

$(document).on('click', '#editar', function (e) {
    var method = $(this).data('method');
    var param = $(this).data('param');

    $.ajax({
        method: 'GET',
        url: 'requests.php',
        data: {
            chave: param,
            modo: 'editar'
        }
    }).done(function(dados){
        var form = '#form',
            dadosObj = jQuery.parseJSON(dados);
        $(form + ' #modo').val('editar');
        $(form + ' #chave').val(dadosObj['usuariosId']);
        $(form + ' #nome').val(dadosObj['nome']);
        $(form + ' #email').val(dadosObj['email']);
        $('#modal h4.modal-title').text('Editar - ' + dadosObj['nome']);
    });
});

$(document).on('click', '#novo', function (e) {
    $('#form input').val('');
    $('#form input#modo').val('novo');
    $('#modal h4.modal-title').text('Adicionar Nova Pessoa');
});
