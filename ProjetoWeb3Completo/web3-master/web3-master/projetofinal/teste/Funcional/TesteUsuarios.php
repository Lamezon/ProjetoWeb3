<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Register');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'login' => 'teste',
            'password' => '1234',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuarios/sucesso');
        $resposta = $this->get(URL_RAIZ . 'usuarios/sucesso');
        $this->verificarContem($resposta, 'Hurray');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE login = "teste"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }
}
