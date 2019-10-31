<?php

/**
 * Trait que cria e retorna um identificador valido com base em um sequencial
 *
 * @package Commbox\Core\DataFile\Traits
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Traits;

use SplFileObject;

trait Integrity
{
    /**
     * Atributo que define o local onde se encontram os arquivos de controle de sequencia
     *
     * @access private
     *
     * @var String
     */
    private $sequencePath = 'public/data/sequence/pessoa.txt';

    /**
     * Método responsável por retonar um id válido com base no nome do sequencial
     *
     * @access protected
     *
     * @return Integer
     */
    protected function getValidId()
    {
        $sequenceFile = new SplFileObject($this->sequencePath, 'a+');
        $sequenceInFile = $sequenceFile->current();
        $validId = 1 + (int) $sequenceInFile;

        $sequenceFile->ftruncate(0);
        $sequenceFile->fwrite($validId);

        return $validId;
    }
}
