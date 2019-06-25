<?php
namespace Modelo;
use \PDO;
use \Framework\DW3BancoDeDados;
class Pergunta extends Modelo
{
    const BUSCAR_TODOS = 'SELECT p.pergunta, p.id_pergunta, u.id, u.login FROM perguntas p JOIN usuarios u ON (p.id_usuario = u.id) ORDER BY p.id_pergunta LIMIT ? OFFSET ?';
    const BUSCAR_ID = 'SELECT * FROM perguntas WHERE id_pergunta = ? LIMIT 1';
    const INSERIR = 'INSERT INTO perguntas(id_usuario,pergunta, alternativa_1, alternativa_2, alternativa_3, alternativa_4, alternativa_5, ) VALUES (?, ?, ?, ?)';
    const DELETAR = 'DELETE FROM pergunta WHERE id_pergunta = ?';
    const CONTAR_TODOS = 'SELECT count(id_pergunta) FROM perguntas';
    private $id;
    private $login;
    private $pergunta;
    private $usuario;
    public function __construct(
        $login,
        $pergunta,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->pergunta = $pergunta;
        $this->usuario = $usuario;
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
        return $this->usuario;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function salvar()
    {
        $this->inserir();
    }
    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->login, PDO::PARAM_INT);
        $comando->bindValue(2, $this->pergunta, PDO::PARAM_STR);
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
                null,
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
            $usuario = new Usuario(
                $registro['login'],
                '',
                null,
                $registro['u_id']
            );
            $objetos[] = new Pergunta(
                $registro['u_id'],
                $registro['pergunta'],
                $usuario,
                $registro['p_id_pergunta']
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
        if (strlen($this->pergunta) < 3) {
            $this->setErroMensagem('pergunta', 'Mínimo 3 caracteres.');
        }
    }
}