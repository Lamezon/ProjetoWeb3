<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
	public function testeInserir()
	{
        $usuario = new Usuario('usuario', 'password', 'password');
        $usuario->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE login = 'usuario'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
	}

    public function testeBuscarLogin()
    {
        $usuario = new Usuario('usuario', 'password', 'password');
        $usuario->salvar();
        $usuario = Usuario::buscarLogin('usuario');
        $this->verificar($usuario !== false);
    }
}
