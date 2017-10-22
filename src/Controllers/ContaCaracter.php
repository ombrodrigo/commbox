<?php

/**
 * Classe responsável por realizar as ações para contagem de carácter
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Controllers;

use Commbox\Core\Controller\Controller;
use Commbox\Core\Scanner\Scanner;

class ContaCaracter extends Controller
{
    public function index(\Commbox\Core\Http\Request $request, \Commbox\Core\Http\Response $response)
    {
        $response->setPage(VIEWS_PATH . '/contaCaracter/index');
    }

    public function processar(\Commbox\Core\Http\Request $request, \Commbox\Core\Http\Response $response)
    {
        try {
            $input = $this->capturaInputPorTipoDeContagem($request);

            $processaContagem   = new Scanner();
            $post               = $request->getPost();
            $caracter           = $post['caracter'];
            $caseSensitive      = isset($post['caseSensitive']) ? true : false;

            $resultado          = $processaContagem->count($input, $caracter, $caseSensitive);
            $ocorrencias        = $resultado['result'];

            $response->setPage(VIEWS_PATH . '/contaCaracter/index', compact('caracter', 'ocorrencias'));
        } catch (\Exception $e) {
            $response->setPage(VIEWS_PATH . '/contaCaracter/index', array('erro' => $e->getMessage()));
        }
    }

    private function capturaInputPorTipoDeContagem(\Commbox\Core\Http\Request $request)
    {
        $post = $request->getPost();

        if (!isset($post['tipoDeContagem']) || empty($post['tipoDeContagem'])) {
            throw new \Exception("Seleciona o tipo de contagem");
        }

        switch ($post['tipoDeContagem']) {
            case (int) 1:
                $this->validarFile($request);
                return new \Commbox\Core\Scanner\File();
                break;

            case (int) 2:
                $this->validarPost($request);
                return new \Commbox\Core\Scanner\Text();
                break;
        }
    }

    private function validarPost(\Commbox\Core\Http\Request $request)
    {
        $post = $request->getPost();

        if (!isset($post['tipoDeContagem']) || empty($post['tipoDeContagem'])) {
            throw new \Exception("Seleciona o tipo de contagem");
        }

        if (!isset($post['caracter']) || empty($post['caracter'])) {
            throw new \Exception("Informe uma pesquisa");
        }

        if (empty($post)) {
            throw new \Exception("Informe os dados do formulário");
        }
    }

    private function validarFile(\Commbox\Core\Http\Request $request)
    {
        $post = $request->getPost();
        $file = $request->getFile();

        if (!isset($post['tipoDeContagem']) || empty($post['tipoDeContagem'])) {
            throw new \Exception("Seleciona o tipo de contagem");
        }

        if (!isset($file['letterInFile']['tmp_name']) || empty($file['letterInFile']['tmp_name'])) {
            throw new \Exception("Selecione um arquivo ou um arquivo menor");
        }

        if (!isset($post['caracter']) || empty($post['caracter'])) {
            throw new \Exception("Informe uma pesquisa");
        }
    }
}
