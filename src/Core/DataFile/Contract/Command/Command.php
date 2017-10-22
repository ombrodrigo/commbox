<?php

/**
 * Interface para todas os objetos de comando
 *
 * @package Commbox\Core\DataFile\Contract\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Contract\Command;

interface Command
{
    /**
     * Método responsável por executar um comando
     *
     * @access public
     *
     * @param Array $params parametros do comandos
     *
     * @return Commbox\Core\DataFile\Command\CommandResult
     */
    public function run($params);
}
