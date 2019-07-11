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
        DW3Sessao::set('id_pergunta', $perguntas->getId());
        DW3Sessao::set('id_usuario', $perguntas->getIdUsuario());
        $_POST['respostaSelecionada']=0;
        $this->visao('perguntas/responder.php', [
            'perguntas' => $perguntas
        ]);
    }
    public function respondida($id)
    {
        $this->verificarLogado();
        $perguntas = Pergunta::buscarId($id);
        $resposta_selecionada =  (int)$_POST['respostaSelecionada'];
        $this->visao('perguntas/responder.php', [
            'perguntas' => $perguntas,
            'resposta' => $resposta_selecionada
        ]);
        $this->armazenarResposta();

    }

    public function armazenarResposta()
    {
        $this->verificarLogado();
        $resposta = new Resposta(

            (int)DW3Sessao::get('id_usuario'),
            (int)DW3Sessao::get('id_pergunta'),
            (int)$_POST['respostaSelecionada']

        );
        $pergunta = Pergunta::buscarId(DW3Sessao::get('id_pergunta'));
        
        Resposta::salvar($resposta);
        Resposta::verificaResposta($resposta, $pergunta);
    }








}
