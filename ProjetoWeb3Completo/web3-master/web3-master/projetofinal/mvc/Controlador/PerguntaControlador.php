<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Pergunta;

class PerguntaControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 5;
        $offset = ($pagina - 1) * $limit;
        $pergunta = Pergunta::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Pergunta::contarTodos() / $limit);
        return compact('pagina', 'pergunta', 'ultimaPagina');
    }

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('perguntas/index.php', [
            'perguntas' => $paginacao['pergunta'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }


    public function armazenarResposta()
    {
        $this->verificarLogado();
        $pergunta = new Pergunta(
            null,
            DW3Sessao::get('id'),
            DW3Sessao::get('usuario'),
            $_POST['resposta']

        );
        var_dump($_POST['resposta']);
    }


        public function armazenar()
    {
        $this->verificarLogado();
        $pergunta = new Pergunta(
            null,
            DW3Sessao::get('id'),
            DW3Sessao::get('usuario'),
            $_POST['dificulty'],
            $_POST['pergunta'],
            $_POST['alternativa_1'],
            $_POST['alternativa_2'],
            $_POST['alternativa_3'],
            $_POST['alternativa_4'],
            $_POST['alternativa_5'],
            $_POST['foto_pergunta'],
            0,
            $_POST['correta']


        );
        if ($pergunta->isValido()) {
            $pergunta->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Question Created!.');
            $this->redirecionar(URL_RAIZ . 'perguntas');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($pergunta->getValidacaoErros());
            $this->visao('perguntas/index.php', [
                'perguntas' => $paginacao['pergunta'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $pergunta = Pergunta::buscarId($id);

        if ($pergunta->getIdUsuario() == DW3Sessao::get('id')) {
            Pergunta::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Question deleted.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Not your question to delete.');
        }
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }
}
