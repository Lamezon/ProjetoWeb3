<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_POR_LOGIN = 'SELECT * FROM usuarios WHERE login = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(login,password) VALUES (?, ?)';
    private $id;
    private $login;
    private $password;
    private $password_secundario;
    private $photo;

    public function __construct(
        $login,
        $password,
        $photo = null,
        $id = null
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->photo = $photo;
        $this->password_secundario = $password;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }


    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->password);
    }

    protected function verificarErros()
    {
        if (strlen($this->login) < 3) {
            $this->setErroMensagem('login', 'Login size is not enough.');
        }

        if (strlen($this->password_secundario) < 3) {
            $this->setErroMensagem('password', 'Password size is not enough.');
        }
        if (self::buscarLogin($this->login) != null ) {
            $this->setErroMensagem('login', 'Login already used.');
        }
        if (DW3ImagemUpload::existeUpload($this->photo)
            && !DW3ImagemUpload::isValida($this->photo)) {
            $this->setErroMensagem('photo', 'Picture with size max = 500 KB.');
        }
        if ($_POST["password"] !== $_POST["password2"]) {
            $this->setErroMensagem('password2', 'Password do not match, try again!');
        }

        if ($_POST["login"] === $_POST["password"]) {
            $this->setErroMensagem('password', 'Login and Password can not be the same!');
        }

    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->login, PDO::PARAM_STR);
        $comando->bindValue(2, $this->password, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarLogin($login)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_LOGIN);
        $comando->bindValue(1, $login, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['login'],
                '',
                null,
                $registro['id']

            );
            $objeto->password = $registro['password'];
        }
        return $objeto;
    }
}
