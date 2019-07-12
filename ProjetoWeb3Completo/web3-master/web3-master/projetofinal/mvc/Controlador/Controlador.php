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

    protected function verificarUsuario($pergunta)
    {
        $login = $this->getLogin();
        if ($login == $pergunta->getCriador()) {
            DW3Sessao::setFlash('mensagemFlash', 'Can not answer your own question.');
            $this->redirecionar(URL_RAIZ . 'perguntas');

        }
    }

    protected function getLogin()
    {
        if ($this->login == null) {

            $login = DW3Sessao::get('login');


        }
        return $login;
    }
}
