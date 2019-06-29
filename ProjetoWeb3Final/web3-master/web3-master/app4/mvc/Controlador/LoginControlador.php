<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/criar.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarLogin($_POST['login']);
        if ($usuario && $usuario->verificarSenha($_POST['password'])) {
            DW3Sessao::set('login', $usuario->getLogin());
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->setErros(['login' => 'Login or Password do not match']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
