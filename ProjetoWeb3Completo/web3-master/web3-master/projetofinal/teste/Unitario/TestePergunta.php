<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Pergunta;
use \Framework\DW3BancoDeDados;

class TestePergunta extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('usuario', 'password', 'password');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
        $this->usuarioLogin = $usuario->getLogin();
    }

    public function testeInserir()
    {
        $pergunta = new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3);
        $pergunta->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM perguntas WHERE id = " . $pergunta->getId());
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['alternativa1'] === $pergunta->getAlternativa1());
    }

    public function testeBuscarTodos()
    {
        (new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3))->salvar();
        (new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a segunda pergunta inserida',
            'alternativa1x', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3))->salvar();
        $perguntas = Pergunta::buscarTodos();
        $this->verificar(count($perguntas) == 2);
    }

    public function testeContarTodos()
    {
        (new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3))->salvar();
        (new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a segunda pergunta inserida',
            'alternativa1x', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3))->salvar();
        $total = Pergunta::contarTodos();
        $this->verificar($total == 2);
    }

    public function testeDestruir()
    {
        $pergunta = new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3);
        $pergunta->salvar();
        Pergunta::destruir($pergunta->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    }
}
