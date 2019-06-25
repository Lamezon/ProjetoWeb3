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
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ . 'perguntas');

        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('login');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
