<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Relatorio
{
    const BUSCAR_FILTRO = 'SELECT p.dificuldade as dificuldade, p.pergunta as pergunta, p.erros as erros FROM perguntas p WHERE dificuldade = ?';


    public static function buscarFiltro($dificuldade)
    {
        DW3BancoDeDados::prepare(self::BUSCAR_FILTRO);
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_FILTRO);
        $comando->bindValue(1, $dificuldade, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Pergunta(
                null,
                null,
                null,
                $registro['dificuldade'],
                $registro['pergunta'],
                null,
                null,
                null,
                null,
                null,
                null,
                $registro['erros'],
                null
            );
        }
        return $objetos;
    }
}
