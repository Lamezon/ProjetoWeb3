<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Pergunta;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('email-teste', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $mensagem = new Pergunta($this->usuarioId, 'Ola pessoal');
        $mensagem->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM perguntas WHERE id = " . $mensagem->getId());
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['texto'] === $mensagem->getPergunta());
    }

    public function testeBuscarTodos()
    {
        (new Pergunta($this->usuarioId, 'Ola pessoal'))->salvar();
        (new Pergunta($this->usuarioId, 'Segunda mensagem'))->salvar();
        $mensagens = Pergunta::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }

    public function testeContarTodos()
    {
        (new Pergunta($this->usuarioId, 'Ola pessoal'))->salvar();
        (new Pergunta($this->usuarioId, 'Segunda mensagem'))->salvar();
        $total = Pergunta::contarTodos();
        $this->verificar($total == 2);
    }

    public function testeDestruir()
    {
        $mensagem = new Pergunta($this->usuarioId, 'Ola pessoal');
        $mensagem->salvar();
        Pergunta::destruir($mensagem->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    }
}
