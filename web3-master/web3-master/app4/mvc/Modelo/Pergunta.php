<?php
namespace Modelo;
use \PDO;
use \Framework\DW3BancoDeDados;
class Pergunta extends Modelo
{
    const BUSCAR_TODOS = 'SELECT u.id, p.pergunta, p.id_pergunta,p.alternativa_1,p.alternativa_2,p.alternativa_3,p.alternativa_4,p.alternativa_5 FROM perguntas p JOIN usuarios u ON (p.id_usuario = u.id) ORDER BY u.id LIMIT ? OFFSET ?';
    const BUSCAR_ID = 'SELECT * FROM perguntas WHERE id_pergunta = ? LIMIT 1';
  //  const BUSCAR_TODOS = 'SELECT * FROM perguntas p JOIN usuarios u ON (p.id_usuario = u.id) ORDER BY u.id LIMIT ? OFFSET ?';
    const INSERIR = 'INSERT INTO perguntas(id_usuario,pergunta, alternativa_1, alternativa_2, alternativa_3, alternativa_4, alternativa_5 ) VALUES (?, ?, ?, ?, ?, ?, ?)';
    const DELETAR = 'DELETE FROM perguntas WHERE id_pergunta = ?';
    const CONTAR_TODOS = 'SELECT count(id_pergunta) FROM perguntas';
    private $id;
    private $login;
    private $pergunta;
    private $usuario;
    private $alternativa1;
    private $alternativa2;
    private $alternativa3;
    private $alternativa4;
    private $alternativa5;
    public function __construct($usuario,
                                $pergunta,
                                $alternativa1,
                                $alternativa2,
                                $alternativa3,
                                $alternativa4,
                                $alternativa5,
                                $id = null
    )

     {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->pergunta = $pergunta;
        $this->alternativa1 = $alternativa1;
        $this->alternativa2 = $alternativa2;
        $this->alternativa3 = $alternativa3;
        $this->alternativa4 = $alternativa4;
        $this->alternativa5 = $alternativa5;

    }
    public function getAlternativa1()
    {
        return $this->alternativa1;
    }
    public function getAlternativa2()
    {
        return $this->alternativa2;
    }
    public function getAlternativa3()
    {
        return $this->alternativa3;
    }
    public function getAlternativa4()
    {
        return $this->alternativa4;
    }
    public function getAlternativa5()
    {
        return $this->alternativa5;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getPergunta()
    {
        return $this->pergunta;
    }
    public function getUsuario()
    {
        return $this-> usuario;
    }
    public function getLogin()
    {
        return $this->login;
    }

    public function salvar()
    {

        $this->verificarErros();

        $this->inserir();
    }
    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuario, PDO::PARAM_INT);
        $comando->bindValue(2, $this->pergunta, PDO::PARAM_STR);
        $comando->bindValue(3, $this->alternativa1, PDO::PARAM_STR);
        $comando->bindValue(4, $this->alternativa2, PDO::PARAM_STR);
        $comando->bindValue(5, $this->alternativa3, PDO::PARAM_STR);
        $comando->bindValue(6, $this->alternativa4, PDO::PARAM_STR);
        $comando->bindValue(7, $this->alternativa5, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }
    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Pergunta(
                $registro['usuario_id'],
                $registro['pergunta'],
                $registro['alternativa1'],
                $registro['alternativa2'],
                $registro['alternativa3'],
                $registro['alternativa4'],
                $registro['alternativa5'],
                $registro['id']
            );
        }
        return $objeto;
    }
    public static function buscarTodos($limit = 10, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Pergunta(
                //$registro['usuario_id'],
                $registro['pergunta'],
                $registro['alternativa_1'],
                $registro['alternativa_2'],
                $registro['alternativa_3'],
                $registro['alternativa_4'],
                $registro['alternativa_5'],
                $registro['id_pergunta']
            );
        }
        return $objetos;
    }
    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }
    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }
    protected function verificarErros()
    {
        if (strlen($this->pergunta) < 10) {
            $this->setErroMensagem('pergunta', 'Mínimo 10 caracteres.');
        }
        if (strlen($this->pergunta) > 1000) {
            $this->setErroMensagem('pergunta', 'Máximo de 1000 caracteres.');
        }
        if (strlen($this->alternativa1) < 10) {
            $this->setErroMensagem('alternativa1', 'Alternativa um, mínimo de 1 caracteres.');
        }
        if (strlen($this->alternativa1) > 200) {
            $this->setErroMensagem('alternativa1', 'Máximo de 200 caracteres.');
        }
        if (strlen($this->alternativa2) < 10) {
            $this->setErroMensagem('alternativa2', 'Alternativa um, mínimo de 1 caracteres.');
        }
        if (strlen($this->alternativa2) > 200) {
            $this->setErroMensagem('alternativa2', 'Máximo de 200 caracteres.');
        }
        if (strlen($this->alternativa3) < 10) {
            $this->setErroMensagem('alternativa3', 'Alternativa um, mínimo de 1 caracteres.');
        }
        if (strlen($this->alternativa3) > 200) {
            $this->setErroMensagem('alternativa3', 'Máximo de 200 caracteres.');
        }
        if (strlen($this->alternativa4) < 10) {
            $this->setErroMensagem('alternativa4', 'Alternativa um, mínimo de 1 caracteres.');
        }
        if (strlen($this->alternativa4) > 200) {
            $this->setErroMensagem('alternativa4', 'Máximo de 200 caracteres.');
        }
        if (strlen($this->alternativa5) < 10) {
            $this->setErroMensagem('alternativa5', 'Alternativa um, mínimo de 1 caracteres.');
        }
        if (strlen($this->alternativa5) > 200) {
            $this->setErroMensagem('alternativa5', 'Máximo de 200 caracteres.');
        }

    }
}