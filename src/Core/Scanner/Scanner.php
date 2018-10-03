<?php

/**
 * Classe responsável por escanear um tipo de input
 *
 * @package Commbox\Core\Scanner
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Scanner;

use Commbox\Core\Scanner\AbstractScanner;

class Scanner
{
    /**
     * Método responsável por contar os caractéres para um tipo de input
     *
     * @access public
     *
     * @param Commbox\Commbox\Core\Scanner\AbstractScanner  $input          input que será utilizado para contagem
     * @param String                                        $letter         caracter a ser pesquisado no conteúdo do input
     * @param Boolean                                       $caseSensitive  define se a verificação dos caracteres será case sensitive
     *
     * @return Commbox\Commbox\Core\Scanner\AbstractScanner::count
     */
    public function count(AbstractScanner $input, $letter, $caseSensitive)
    {
        return $input->count($letter, $caseSensitive);
    }
}
