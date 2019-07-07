<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Pergunta;
use Modelo\Resposta;


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
    public function respondida($id)
    {
        $this->verificarLogado();
        $perguntas = Pergunta::buscarId($id);
        $resposta_selecionada = $_POST['respostas'];
        $this->visao('perguntas/responder.php', [
            'perguntas' => $perguntas,
            'resposta' => $resposta_selecionada
        ]);
        Resposta::inserir();
    }








}
