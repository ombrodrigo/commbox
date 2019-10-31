<?php

/**
 * Classe responsável por realizar as ações para cadastro de pessoa
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Controllers;

use Commbox\Core\Controller\Controller;
use Commbox\Core\DataFile\DataFile;
use Commbox\Core\Http\Request;
use Commbox\Core\Http\Response;

class CadastroPessoa extends Controller
{
    public function index(Request $request, Response $response)
    {
        $existePesquisa = false;
        $command = 'findAll';
        $post = $request->getPost();
        $registros = null;

        if (!empty($post['key']) && !empty($post['value'])) {
            $existePesquisa = true;
        }

        $dataFile = new DataFile();

        if ($existePesquisa === true) {
            $command = 'search';
        }

        $registros = $dataFile->$command($post);

        $response->setPage(VIEWS_PATH . '/cadastroPessoa/index', compact('registros'));
    }

    public function novo(Response $response)
    {
        $response->setPage(VIEWS_PATH . '/cadastroPessoa/formulario');
    }

    public function atualizar(Request $request, Response $response)
    {
        $get = $request->getGet();
        $dataFile = new DataFile();
        $registro = $dataFile->find($get['id']);
        $response->setPage(VIEWS_PATH . '/cadastroPessoa/formulario', compact('registro'));
    }

    public function excluir(Request $request)
    {
        $get = $request->getGet();
        $dataFile = new DataFile();
        $dataFile->delete($get['id']);

        header('Location: ?cadastroPessoa');
    }

    public function salvar(Request $request, Response $response)
    {
        $erros = $this->validarFormulario($request, false);

        if (empty($erros)) {
            $this->ordenaCamposPost($request);
            $post = $request->getPost();
            $dataFile = new DataFile();
            $dataFile->insert($post);

            header('Location: ?cadastroPessoa');
        }

        $response->setPage(VIEWS_PATH . '/cadastroPessoa/formulario', compact('erros'));
    }

    public function atualizarRegistro(Request $request, Response $response)
    {
        $erros = $this->validarFormulario($request, true);

        if (empty($erros)) {
            $this->ordenaCamposPost($request);
            $post = $request->getPost();
            $dataFile = new DataFile();
            $dataFile->update($post);

            header('Location: ?cadastroPessoa');
        }

        $response->setPage(VIEWS_PATH . '/cadastroPessoa/formulario', compact('erros'));
    }

    private function validarFormulario(Request $request, $validarId)
    {
        $erros = array();
        $post = $request->getPost();
        $camposValidar = array(
            'nome' => 'Informe o nome',
            'senha' => 'Informe a senha',
            'dataNascimento' => 'Informe a data de nascimento',
            'cidade' => 'Informe a cidade',
            'cpf' => 'Informe o CPF',
            'pai' => 'Informe o nome do pai',
            'mae' => 'Informe o nome da mãe',
        );

        if ($validarId == true) {
            $camposValidar['id'] = 'Não foi localizado o id';
        }

        foreach ($camposValidar as $campo => $mensagemErro) {
            if (!isset($post[$campo]) || empty($post[$campo])) {
                $erros[$campo] = $mensagemErro;
            }
        }

        return $erros;
    }

    private function ordenaCamposPost(Request $request)
    {
        $post = $request->getPost();
        $ordem = array(
            'id',
            'nome',
            'senha',
            'dataNascimento',
            'cidade',
            'cpf',
            'pai',
            'mae',
            'observacao',
        );

        unset($_POST);

        foreach ($ordem as $atributo) {
            if (isset($post[$atributo])) {
                $_POST[$atributo] = $post[$atributo];
            }
        }
    }
}
