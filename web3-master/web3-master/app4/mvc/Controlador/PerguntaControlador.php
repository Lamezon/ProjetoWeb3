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
            'pergunta' => $paginacao['pergunta'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $pergunta = new Pergunta(
            DW3Sessao::get('usuario'),
            $_POST['pergunta'],
            $_POST['alternativa1'],
            $_POST['alternativa2'],
            $_POST['alternativa3'],
            $_POST['alternativa4'],
            $_POST['alternativa5']
        );
        if ($pergunta->isValido()) {
            $pergunta->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Pergunta cadastrada.');
            $this->redirecionar(URL_RAIZ . 'perguntas');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($pergunta->getValidacaoErros());
            $this->visao('perguntas/index.php', [
                'pergunta' => $paginacao['pergunta'],
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
        if ($pergunta->getLogin() == $this->getUsuario()) {
            Pergunta::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Pergunta deletada.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as perguntas dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }
}
