<?php

/**
 * Trait que mantem as ações de escrita de uma linha
 *
 * @package Commbox\Core\DataFile\Traits
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Traits;

trait Write
{
    /**
     * Atributo que ira manter os registros que irão compor a linha
     *
     * @access private
     *
     * @var Integer
     */
    private $records = null;

    /**
     * Método responsável por retornar os registros
     *
     * @access protected
     *
     * @return Array
     */
    protected function getRecords()
    {
        return $this->records;
    }

    /**
     * Método responsável por iniciar o processo de escrita de uma nova linha
     *
     * @access protected
     *
     * @return void
     */
    protected function start()
    {
        $this->records = array();
    }

    /**
     * Método responsável adicionar um registro
     *
     * @access protected
     *
     * @param String    $value  valor a ser adicionado
     * @param Integer   $length tamanho da string a ser escrita
     *
     * @return Write
     */
    protected function add($value, $length)
    {
        # @TODO pesquisar maneira de corrigir o problema do UTF8 no str_pad, por esse problema não esta aceitando acentos
        $this->records[] = str_pad(substr($this->removeAccent($value), 0, $length), $length, " ", STR_PAD_RIGHT);
    }

    /**
     * Método responsável por retornar os registros em linha
     *
     * @access protected
     *
     * @param String $lineBreak     define uma quebra de linha
     *
     * @return String
     */
    protected function inLine($lineBreak)
    {
        return implode('', $this->records) . $lineBreak;
    }

    /**
     * Método responsável por finalizar o processo de escrita de uma nova linha
     *
     * @access protected
     *
     * @return Write
     */
    protected function finish()
    {
        $inLine = $this->inLine(PHP_EOL);

        #@TODO ver forma de testar sem esse if
        (property_exists($this, 'resource')) ? $this->resource->fwrite($inLine) : $this->fwrite($inLine);
    }

    /**
     *
     * @TODO remover este método para outra classe, devido a coesão do objeto
     * Método responsável por remover os acentos de uma string
     *
     * Método desenvolvido com base neste link
     * @link https://forum.imasters.com.br/topic/502244-remover-acentos-em-strings-php/
     *
     * @access protected
     *
     * @param String $string string a ser tratada
     *
     * @return String
     */
    protected function removeAccent($string)
    {
        $mapChars = array(
            'Á' => 'A', 'À' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Å' => 'A', 'Ä' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'Eth',
            'Ñ' => 'N', 'Ó' => 'O', 'Ò' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
            'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
            'á' => 'a', 'à' => 'a', 'â' => 'a', 'ã' => 'a', 'å' => 'a', 'ä' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'eth',
            'ñ' => 'n', 'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ŕ' => 'r', 'ÿ' => 'y',
            'ß' => 'sz', 'þ' => 'thorn',
        );

        return strtr($string, $mapChars);
    }
}
