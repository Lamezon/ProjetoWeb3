<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Pergunta;


class ResponderControlador extends Controlador
{

    public function index($id)
    {
        $this->verificarLogado();
        $perguntas = Pergunta::buscarId($id);
        $this->visao('perguntas/responder.php', [
            'perguntas' => $perguntas
        ]);
    }





}
