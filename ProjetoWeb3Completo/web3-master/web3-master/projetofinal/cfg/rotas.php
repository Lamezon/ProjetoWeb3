<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/perguntas' => [
        'GET' => '\Controlador\PerguntaControlador#index',
        'POST' => '\Controlador\PerguntaControlador#armazenar',
    ],
    '/perguntas/?' => [
        'DELETE' => '\Controlador\PerguntaControlador#destruir',
    ],
    '/perguntas/responder/?' => [
        'GET' => '\Controlador\ResponderControlador#index',
        'POST' => '\Controlador\ResponderControlador#respondida',
    ],
    '/perguntas/relatorio' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],
];
