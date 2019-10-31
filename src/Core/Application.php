<?php

/**
 * Classe responsável por representar a aplicação
 *
 * @package Commbox\Core
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core;

use Commbox\Core\Http\Request;
use Commbox\Core\Http\Response;
use Commbox\Controllers\ContaCaracter;
use Commbox\Controllers\CadastroPessoa;

class Application
{
    /**
     * Atributo responsável por manter a instancia de Request
     *
     * @access public
     *
     * @var Commbox\Core\Http\Request
     */
    public $Request = null;

    /**
     * Atributo responsável por manter a instancia de Response
     *
     * @access public
     *
     * @var Commbox\Core\Http\Response
     */
    public $Response = null;

    /**
     * Método de inicialização do objeto
     *
     * @access public
     */
    public function __construct()
    {
        // instancia os objetos de Request e Response
        $this->Request = new Request;
        $this->Response = new Response;
    }

    /**
     * Método responsável por definir as rotas do projeto
     *
     * @access public
     *
     * @return void
     */
    public function run()
    {
        # home
        $this->Request->routeGet('/', function() {
            $this->Response->setPage(SRC_PATH . '/Views/main/home');
        });

        /**
         * Conta caracter
         */
        # formulario conta caracter
        $this->Request->routeGet('contaCaracter', function() {
            ContaCaracter::init()->index($this->Request, $this->Response);
        });

        # formulario post conta caracter
        $this->Request->routePost('contaCaracter', function() {
            ContaCaracter::init()->processar($this->Request, $this->Response);
        });

        /**
         * Cadastro pessoa
         */
        # grid
        $this->Request->routeGet('cadastroPessoa', function() {
            CadastroPessoa::init()->index($this->Request, $this->Response);
        });

        # cadastro
        $this->Request->routeGet('cadastroPessoa/novo', function() {
            CadastroPessoa::init()->novo($this->Response);
        });

        # cadastro salvar
        $this->Request->routePost('cadastroPessoa/novo', function() {
            CadastroPessoa::init()->salvar($this->Request, $this->Response);
        });

        # atualizar
        $this->Request->routeGet('cadastroPessoa/atualizar', function() {
            CadastroPessoa::init()->atualizar($this->Request, $this->Response);
        });

        # atualizar resgitro
        $this->Request->routePost('cadastroPessoa/atualizarRegistro', function() {
            CadastroPessoa::init()->atualizarRegistro($this->Request, $this->Response);
        });

        # excluir resgitro
        $this->Request->routeGet('cadastroPessoa/excluir', function() {
            CadastroPessoa::init()->excluir($this->Request);
        });

         # excluir pesquisar
        $this->Request->routePost('cadastroPessoa', function() {
            CadastroPessoa::init()->index($this->Request, $this->Response);
        });
    }
}
