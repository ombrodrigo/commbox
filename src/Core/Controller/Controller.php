<?php

/**
 * Classe responsável por representar os controllers
 *
 * @package Commbox\Core\Controller
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Controller;

abstract class Controller
{
    /**
     * Método estático para execução de ações do controller sem a necessidade de realizar
     * a instancia do mesmo
     *
     * @access public
     *
     * @return Commbox\Core\Controller\Controller
     */
    public static function init()
    {
        $namespaceController = get_called_class();
        return new $namespaceController();
    }

    /**
     * Método padrão de todos os controllers
     *
     * @access public
     *
     * @param Commbox\Core\Http\Request     $request
     * @param Commbox\Core\Http\Response    $response
     *
     * @return void
     */
    abstract public function index(\Commbox\Core\Http\Request $request, \Commbox\Core\Http\Response $response);
}
