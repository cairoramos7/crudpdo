<?php
/**
 * Created by PhpStorm.
 * User: cairo
 * Date: 01/05/2017
 * Time:  01:09 - AM
 */

include_once "ICrud.php";
include_once "Conexao.php";

class Dao implements ICrud
{
    private $table;
    private $conexao;

    public function __construct()
    {
        $this->table = 'usuarios';
        $this->conexao = Conexao::getInstance();
    }

    public function novo($objeto)
    {
        $sql = "INSERT INTO $this->table (nome, email, senha) VALUES(:nome, :email, :senha)";
        try{
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':nome', $objeto->getNome(), PDO::PARAM_STR);
            $query->bindValue(':email', $objeto->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':senha', $objeto->getSenha(), PDO::PARAM_STR);
            $query->execute();

            header('Location: /');
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function apagar($parametro)
    {
        $sql = "DELETE FROM $this->table WHERE usuariosId = :chave";
        try{
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':chave', $parametro, PDO::PARAM_INT);
            $query->execute();
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM $this->table ORDER BY usuariosId";
        try{
            $query = $this->conexao->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function ler($parametro)
    {
        $sql = "SELECT * FROM $this->table WHERE usuariosId = :usuarioId";
        try{
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':usuarioId', $parametro, PDO::PARAM_INT);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado;
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function atualizar($objeto)
    {
        $sql = "UPDATE $this->table SET nome = :nome, email = :email, senha = :senha WHERE usuariosId = :chave";
        try{
            $query = $this->conexao->prepare($sql);
            $query->bindValue(':nome', $objeto->getNome());
            $query->bindValue(':email', $objeto->getEmail());
            $query->bindValue(':senha', $objeto->getSenha());
            $query->bindValue(':chave', $objeto->getChave(), PDO::PARAM_INT);
            $query->execute();
        }
        catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }
}