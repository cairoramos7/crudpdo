<?php
/**
 * Created by PhpStorm.
 * User: cairo
 * Date: 01/05/2017
 * Time:  01:07 - AM
 */

class Usuarios
{
    protected $chave;
    protected $nome;
    protected $email;
    protected $senha;

    public function __construct($chave, $nome, $email, $senha)
    {
        $this->chave = $chave;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getChave()
    {
        return $this->chave;
    }

    /**
     * @param mixed $chave
     */
    public function setChave($chave)
    {
        $this->chave = $chave;
    }
    
    

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}