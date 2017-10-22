<?php

/**
 * Classe reponsável por manter ações em comum para todos os scanners
 *
 * @package Commbox\Core\Scanner
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Scanner;

abstract class AbstractScanner
{
    /**
     * Método responsável por contar quantas vezes um determinado carácter aparece em uma string
     *
     * @access public
     *
     * @param String    $letter         caracter a ser pesquisado na string
     * @param Boolean   $caseSensitive  define se a verificação dos caracteres será case sensitive
     *
     * @return Array
     *          letter  : caracter informado para pesquisa
     *          result : numero de ocorrencias do caracter
     */
    public function count($letter, $caseSensitive)
    {
        if ($this->validate() == false) {
            throw new \Exception(
                sprintf(
                    "A requisição realizada para %s não é valida",
                    substr(get_class($this), strrpos(get_class($this), '\\') + 1)
                )
            );
        }

        $content        = $this->getContent();
        $letterCheck    = $letter;

        if ($caseSensitive == false) {
            $content        = strtolower($content);
            $letterCheck    = strtolower($letterCheck);
        }

        $result = substr_count($content, $letterCheck);

        return compact('letter', 'result');
    }

    /**
     * Método responsável por realizar a validação de um input
     *
     * @access protected
     *
     * @return Boolean
     */
    abstract protected function validate();

    /**
     * Método responsável por capturar o conteúdo de um input
     *
     * @access protected
     *
     * @return String
     */
    abstract protected function getContent();
}
