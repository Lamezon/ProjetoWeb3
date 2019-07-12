<?php
namespace teste;

use \Modelo\Usuario;
use \framework\DW3Teste;
use \Framework\DW3Sessao;




class Teste extends DW3Teste
{
	protected $usuario;
	public function logar()
	{
		$this->usuario = new Usuario('usuario', 'usuario123');
		$this->usuario->salvar();
		DW3Sessao::set('usuario', $this->usuario->getId());
	}
}
