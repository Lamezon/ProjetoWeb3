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
        (new Usuario('matheus', '12345'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'matheus',
            'password' => '12345'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $this->verificar(DW3Sessao::get('usuarios') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'matheus',
            'password' => 'matheus'
        ]);
        $this->verificarContem($resposta, 'matheus');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('matheus', '12345'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'matheus',
            'password' => '12345'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
