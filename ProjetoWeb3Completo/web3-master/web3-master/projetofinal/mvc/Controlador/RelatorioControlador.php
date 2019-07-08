<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Pergunta;
use Modelo\Relatorio;


class RelatorioControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $this->visao('perguntas/relatorio.php', [
            $valor = intval($_GET['filterSelect']),
            'perguntas' =>Pergunta::buscarTodos(),
            'registros' => Pergunta::buscarFiltro($valor)

        ]);
    }





}
