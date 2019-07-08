<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Resposta extends Modelo
{
    const INSERIR = 'INSERT INTO `usuarioresposta` (`id_usuario`, `id_pergunta`, `resposta`) VALUES ( ?, ?, ?);';
    private $id_usuario;
    private $id_pergunta;
    private $resposta;

    public function __construct(
        $id_usuario,
        $id_pergunta,
        $resposta
    )
    {
        $this->id_usuario = $id_usuario;
        $this->id_pergunta = $id_pergunta;
        $this->resposta = $resposta;
    }


    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getIdPergunta()
    {
        return $this->id_pergunta;
    }

    public function getResposta()
    {
        return $this->resposta;
    }

    public function salvar($resposta)
    {

       Resposta::inserir($resposta);

    }

    private function inserir($resposta)
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $resposta->getIdUsuario(), PDO::PARAM_INT);
        $comando->bindValue(2, $resposta->getIdPergunta(), PDO::PARAM_INT);
        $comando->bindValue(3, $resposta->getResposta(), PDO::PARAM_INT);
        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();
    }


}
