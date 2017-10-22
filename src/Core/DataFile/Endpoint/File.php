<?php

/**
 * Classe responsável por criar o resource para manipulação do arquivo
 *
 * @package Commbox\Core\DataFile\Endpoint
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Endpoint;

abstract class File extends \SplFileObject
{
    /**
     * Constante que define o local e o nome do arquivo onde se encontra os dados
     */
    const DATA_FILE = 'public/data/pessoa.txt';

    /**
     * Método de inicialização do objeto, responsável por abrir o arquivo e criar o resource do mesmo
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(self::DATA_FILE, 'a+');
    }
}
