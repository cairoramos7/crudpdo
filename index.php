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
    <link rel="stylesheet" type="text/css" charset="UTF-8" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script type="text/javascript" charset="UTF-8" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/bootbox.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/custom.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="fontS-22">Crud POO Com PDO</h1>
            <hr>
            <?php if(!empty($listaPessoas)): ?>
            <button type="button" class="btn-person-2" id="novo" data-toggle="modal" data-target="#modal">
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
                        <button class="btn btn-xs btn-info" id="editar" data-toggle="modal" data-method="editar" data-param="<?= base64_encode($item->usuariosId) ?>" data-target="#modal">
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
                <h2 class="text-center text-light">Nenhuma Informação</h2>
                <div class="text-center">
                    <button class=" btn-person " id="novo" data-toggle="modal" data-target="#modal">
                        <span class="lnr lnr-plus-circle"></span>
                        <span class="text-bold">Adicionar Novo</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <div class="modal fade " id="modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Adicionar Nova Pessoa</h4>
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
                                <input type="password" id="senha" value="" minlength="5" maxlength="15" name="senha" required class="form-control">
                            </div>
                            <button class="btn btn-sm btn-primary"><span class="lnr lnr-download"></span> Salvar</button>
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><span class="lnr lnr-cross"></span> Fechar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>