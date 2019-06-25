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
        $photo = array_key_exists('photo', $_FILES) ? $_FILES['photo'] : null;
        $usuario = new Usuario($_POST['login'], $_POST['password'], $photo);

        if ($usuario->isValido()) {

            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');

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
