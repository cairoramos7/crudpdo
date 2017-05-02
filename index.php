<?php

include_once 'app/Dao.php';
$pdo = new Dao();

$listaPessoas = $pdo->listar();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD POO</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" charset="UTF-8" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script type="text/javascript" charset="UTF-8" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <style type="text/css">
        *{
            font-family: 'Roboto', sans-serif;
        }
        .text-light{
            font-weight: 100;
        }
        .text-regular{
            font-weight: 400;
        }
        .text-bold{
            font-weight: 700;
        }
        .fontS-22{
            font-size: 22px;
        }
    </style>
    <script type="text/javascript" charset="UTF-8">
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
                    })
                        .done(function( msg ) {
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
            });
        });

        $(document).on('click', '#novo', function (e) {
            $('#form input').val('');
            $('#form input#modo').val('novo');
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="fontS-22">Crud POO With PDO</h1>
            <hr>
            <?php if(!empty($listaPessoas)): ?>
            <button type="button" class="btn btn-success btn-sm" id="novo" data-toggle="modal" data-target="#modal">
                <span class="lnr lnr-plus-circle"></span>
                Novo
            </button>
            <hr>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th class="text-center" style="width: 90px;">Ação</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($listaPessoas as $key => $item): ?>

                <tr>
                    <td><?= $item->nome ?></td>
                    <td><?= $item->email ?></td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-info" id="editar" data-toggle="modal" data-method="editar" data-param="<?= $item->usuariosId ?>" data-target="#modal">
                            <span class="lnr lnr-pencil"></span>
                        </button>

                        <button class="btn btn-xs btn-danger" id="delete" data-uri="/" data-method="apagar" data-drop="<?= $item->usuariosId ?>">
                            <span class="lnr lnr-trash"></span>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <h2 class="text-center text-light">Nenhuma Informação Cadastrada</h2>
                <div class="text-center">
                    <button class=" btn btn-sm btn-default" id="novo" data-toggle="modal" data-target="#modal"><span class="lnr lnr-plus-circle"></span> Adicionar Novo</button>
                </div>
            <?php endif; ?>
        </div>

        <div class="modal fade " id="modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Adicionar Nova Pessao</h4>
                    </div>
                    <div class="modal-body">
                        <form action="requests.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8" class="" id="form" >
                            <input type="hidden" id="modo" name="modo" value="novo">
                            <input type="hidden" id="chave" name="chave" value="">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" value="" class="form-control" name="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" value="" name="email" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" id="senha" value="" name="senha" required class="form-control">
                            </div>
                            <button class="btn btn-sm btn-success"><span class="lnr lnr-download"></span> Salvar</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><span class="lnr lnr-cross"></span> Fechar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>