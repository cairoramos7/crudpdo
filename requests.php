<?php

include_once 'app/Dao.php';
include_once 'app/Usuarios.php';
$pdo = new Dao();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $modo = filter_input(INPUT_POST, 'modo');
    switch ($modo):
        case 'novo':
            include_once 'app/Usuarios.php';

            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email');
            $senha = filter_input(INPUT_POST, 'senha');

            $usuario = new Usuarios(null, $nome, $email, $senha);

            if($pdo->novo($usuario)){
                $retorno = [
                    'mensagem' => 'Salvo com Sucesso'
                ];

                echo json_encode($retorno);
            }

            break;

        case 'apagar':
            $pdo->apagar(filter_input(INPUT_POST, 'chave', FILTER_VALIDATE_INT));
            break;

        case 'editar':
            $chave = filter_input(INPUT_POST, 'chave');
            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email');
            $senha = filter_input(INPUT_POST, 'senha');

            $usuario = new Usuarios($chave, $nome, $email, $senha);

            if($pdo->atualizar($usuario)){
                $retono = [
                    'mensagem' => 'Atualizado com Sucesso'
                ];
            }

            header('Location: /');
            break;
    endswitch;
}


if(isset($_GET['modo']) && $_GET['modo'] == 'editar'){
    $usuarioEncoded = filter_input(INPUT_GET, 'chave');
    $usuarioId = base64_decode($usuarioEncoded);
    $retorno = $pdo->ler($usuarioId);
    echo json_encode($retorno);
}