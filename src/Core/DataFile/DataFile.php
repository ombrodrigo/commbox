<?php
/**
 *
 * Classe responsável por permitir executar todos os comandos de manipulação do arquivo
 *
 * @package Commbox\Core\DataFile
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile;

use Commbox\Core\DataFile\Endpoint\CommandBuilder;

class DataFile extends CommandBuilder
{
    /**
     * Método responsável por executar ações de forma dinâmica com base no command informado
     *
     * @access public
     *
     * @param String $command   command a ser executado
     * @param Array $arguments  argumentos enviados para o builder
     *
     * @return resultado do método invocado
     */
    public function __call($command, $arguments = null)
    {
        return $this->runBuilder($command, $arguments);
    }

    /**
     * Método responsável executar o command
     *
     * @access private
     *
     * @param String $command  command a ser executado
     * @param Array $arguments  argumentos enviados para o builder
     *
     * @return resultado do command
     */
    private function runBuilder($command, $arguments = null)
    {
        // instancia a classe responsável por criar o Builder
        $commandBuilder = new CommandBuilder();

        // execta o builder e retorna o resultado
        return $commandBuilder->invoke($command, $arguments);
    }
}
