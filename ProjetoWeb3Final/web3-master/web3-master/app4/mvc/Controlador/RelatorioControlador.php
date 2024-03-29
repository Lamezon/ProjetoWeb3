<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Pergunta;


class RelatorioControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $perguntas = Pergunta::buscarTodos();
        $this->visao('perguntas/relatorio.php', [
            'perguntas' => $perguntas
        ]);
    }

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 5;
        $offset = ($pagina - 1) * $limit;
        $pergunta = Pergunta::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Pergunta::contarTodos() / $limit);
        return compact('pagina', 'pergunta', 'ultimaPagina');
    }



}
