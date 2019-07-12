<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Pergunta;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TestePerguntas extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'perguntas');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeListagem()
    {
        $this->logar();
        (new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3))->salvar();
        $resposta = $this->get(URL_RAIZ . 'perguntas');
        $this->verificarContem($resposta, 'Create Question');
        $this->verificarContem($resposta, 'Essa é a');
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
        $mensagem = new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3);
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'perguntas/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdPerguntas = $query->fetch();
        $this->verificar($bdPerguntas === false);
    }

    public function testeDestruirDeOutroUsuario()
    {
        $this->logar();
        $outroUsuario = new Usuario('usuario2', '123', '123');
        $outroUsuario->salvar();
        $mensagem = new Pergunta($id = null, $this->usuarioId, $this->usuarioLogin, '1', 'Essa é a pergunta inserida',
            'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', null, 0, 3);
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'perguntas/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $query = DW3BancoDeDados::query('SELECT * FROM perguntas');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao !== false);
    }
}
