<?php

/**
 * Classe responsável por manipular todas as requisições da aplicação
 *
 * @package Commbox\Core\Http
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Http;

class Request
{
    /**
     * Constantes que definem as posições de controller e action da url
     */
    const CONTROLLER_POSITION = 1;
    const ACTION_POSITION = 2;

    /**
     * @return Array
     */
    public function getGet()
    {
        return isset($_GET) ? $_GET : null;
    }

    /**
     * @return Array
     */
    public function getPost()
    {
        return isset($_POST) ? $_POST : null;
    }

    /**
     * @return Array
     */
    public function getFile()
    {
        return isset($_FILES) ? $_FILES : null;
    }

    /**
     * @return Array
     */
    public function getRequest()
    {
        return isset($_REQUEST) ? $_REQUEST : null;
    }

    /**
     * @return String
     */
    public function getController()
    {
        return $this->getPositionUrl(self::CONTROLLER_POSITION);
    }

    /**
     * @return String
     */
    public function getAction()
    {
        return $this->getPositionUrl(self::ACTION_POSITION);
    }

    /**
     * Método responsável por retornar a Uri solicitada
     *
     * @access private
     *
     * @return String
     */
    public function getUri()
    {
        return empty($this->getGet()) ? '/' : current(array_keys($this->getGet()));
    }

    /**
     * Método responsável por retornar uma posição da URL com pase na posições desejada
     *
     * @access public
     *
     * @param Integer $position posição a ser capturada
     *
     * @return String
     */
    public function getPositionUrl($position)
    {
        // captura a requisição realizada
        $request = explode("/", $this->getUri());

        // retorna o resultado com base na posição informada
        switch ($position) {
            case self::CONTROLLER_POSITION:
                return current($request);
                break;

            case self::ACTION_POSITION:
                return end($request);
                break;
        }
    }

    public function routeGet($uri, $callback)
    {
        if (!empty($this->getPost())) {
            return null;
        }

        $this->checkRouteRunCallback($uri, $callback);
    }

    public function routePost($uri, $callback)
    {
        if (empty($this->getPost())) {
            return null;
        }

        $this->checkRouteRunCallback($uri, $callback);
    }

    public function checkRouteRunCallback($uri, $callback)
    {
        if (strcmp($uri, $this->getUri()) == 0) {
            $callback();
        }
    }
}
