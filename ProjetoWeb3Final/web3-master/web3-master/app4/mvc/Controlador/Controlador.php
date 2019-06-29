<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\Usuario;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;

    protected $login;

    protected function verificarLogado()
    {
        $login = $this->getLogin();
        if ($login == null) {
            $this->redirecionar(URL_RAIZ . 'login');
        }
    }

    protected function getLogin()
    {
        if ($this->login == null) {

            var_dump(DW3Sessao::get('usuarios'));
            exit();
            $login = DW3Sessao::get('login');
        }
        return $login;
    }
}
