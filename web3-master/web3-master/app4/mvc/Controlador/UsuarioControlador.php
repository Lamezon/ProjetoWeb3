<?php
namespace Controlador;

use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $usuario = new Usuario($_POST['login'], $_POST['password'], $foto);

        if ($usuario->isValido()) {
            if($_POST["password"] === $_POST["password2"]) {
                if($_POST["login"] !== $_POST["password"]) {
                    $usuario->salvar();
                    $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');
                }else{
                    $this->setErros($usuario->getValidacaoErros());
                    $this->visao('usuarios/criar.php');
                }
            }else{
                $this->setErros($usuario->getValidacaoErros());
                $this->visao('usuarios/criar.php');
            }
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
    }



    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
}
