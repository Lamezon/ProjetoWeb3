<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Pergunta;


class ResponderControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        
    }



    public function sucesso()
    {
        $this->visao('index.php');
    }
}
