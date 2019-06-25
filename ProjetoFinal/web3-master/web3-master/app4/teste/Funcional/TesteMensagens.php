<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Pergunta;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteMensagens extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'perguntas');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeListagem()
    {
        $this->logar();
        (new Pergunta($this->usuario->getId(), 'Olá'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'perguntas');
        $this->verificarContem($resposta, 'Escreva a mensagem');
        $this->verificarContem($resposta, 'Olá');
    }

    public function testeArmazenarDeslogado()
    {
        $resposta = $this->post(URL_RAIZ . 'perguntas', [
            'texto' => 'Olá deslogado'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'perguntas', [
            'texto' => 'Olá logado'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }

    public function testeDestruir()
    {
        $this->logar();
        $mensagem = new Pergunta($this->usuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'perguntas/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao === false);
    }

    public function testeDestruirDeOutroUsuario()
    {
        $this->logar();
        $outroUsuario = new Usuario('teste2@teste2.com', '123');
        $outroUsuario->salvar();
        $mensagem = new Pergunta($outroUsuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'perguntas/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao !== false);
    }
}
