<?php

/**
 * Created by PhpStorm.
 * User: cairo
 * Date: 01/05/2017
 * Time:  09:27 - AM
 */
interface ICrud
{
    public function novo($objeto);
    public function listar();
    public function ler($parametro);
    public function atualizar($objeto);
    public function apagar($parametro);
}