<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogin()
    {

        (new Usuario('usuario', 'password', 'password'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'usuario',
            'password' => 'password'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $this->verificar(DW3Sessao::get('login') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'testeerrado',
            'password' => 'password'
        ]);
        $this->verificarContem($resposta, 'testeerrado');
        $this->verificar(DW3Sessao::get('login') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('usuario', 'password', 'password'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'usuario',
            'password' => 'password'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('login') == null);
    }
}
