<?php

/**
 * Classe responsável por manipular as resposta do servidor para o client
 *
 * @package Commbox\Core\Http
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Http;

class Response
{
    /**
     * Atributo responsável por manter a pagina a ser renderizada
     *
     * @access private
     *
     * @var String
     */
    private $pageRender = null;

    /**
     * Atributo responsável por manter os dados que serão enviados como resposta
     *
     * @access private
     *
     * @var Array
     */
    private $responseData = null;


    public function __construct()
    {
        $this->responseData = array();
        $this->pageRender   = null;
    }

    /**
     * Método reponsável por setar as informações que serão enviadas como resposta
     *
     * @access public
     *
     * @param String $key
     * @param String $value
     *
     * @return void
     */
    public function setResponse($key, $value)
    {
        $this->responseData[$key] = $value;
    }

    /**
     * Método reponsável por setar as informações que serão enviadas como resposta a partir de uma array
     *
     * @access public
     *
     * @param Array $data dados que serão adicionados na resposta
     *
     * @return void
     */
    public function setResponseArray($data = null)
    {
        if (empty($data)) {
            return null;
        }

        foreach ($data as $key => $value) {
            $this->responseData[$key] = $value;
        }
    }

    /**
     * Método responsável por setar a pagina a ser renderizada
     *
     * @access public
     *
     * @param String    $page   pagina que será renderizada
     * @param Array $data dados que serão adicionados na resposta
     *
     * @return void
     */
    public function setPage($page, $data = null)
    {
        $this->pageRender = $page . '.php';
        $this->setResponseArray($data);
    }

    /**
     * Método responsável por renderizar a pagina e seus dados
     *
     * @access public
     *
     * @return void
     */
    public function render()
    {
        if (empty($this->pageRender) || !file_exists($this->pageRender)) {
            return false;
        }

        if (!empty($this->responseData)) {
            // percorre os dados e cria as variaveis a pagina
            foreach ($this->responseData as $varName => $varValue) {
                $$varName = $varValue;
            }
        }

        include_once $this->pageRender;
    }
}
