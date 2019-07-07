<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Resposta extends Modelo
{
    const INSERIR = 'INSERT INTO `usuarioresposta` (`id`, `id_usuario`, `id_pergunta`, `resposta`) VALUES (?, ?, ?, ?);';
    private $id;
    private $id_usuario;
    private $id_pergunta;
    private $resposta;

    public function __construct(
        $id_usuario,
        $id_pergunta,
        $resposta,
        $id = null
    )
    {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->id_pergunta = $id_pergunta;
        $this->resposta = $resposta;
    }

    public function getId()
    {
        return $this->id;
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

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->id, PDO::PARAM_STR);
        $comando->bindValue(2, $this->id_usuario, PDO::PARAM_STR);
        $comando->bindValue(3, $this->id_pergunta, PDO::PARAM_STR);
        $comando->bindValue(4, $this->resposta, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }


    protected function verificarErros()
    {
        if (1==1) {
            $this->setErroMensagem('respostas', 'Question, minimium size: 10 characters.');
        }

    }
}
