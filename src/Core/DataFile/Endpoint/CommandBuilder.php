<?php
/**
 *
 * Classe responsável por executar um commando de acordo com o commmand solicitado
 *
 * @package Commbox\Core\DataFile\Endpoint
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Endpoint;

class CommandBuilder
{
    /**
     * Constante que define o namespaces padrão dos commands
     */
    const NAMESPACE_CLASS = 'Commbox\Core\DataFile\Command\\';

    /**
     * Método responsável por invocar o command solicitada
     *
     * @access public
     *
     * @param String $command command a ser invocado
     * @param Array $arguments  argumentos enviados para o builder
     *
     * @return Object instancia do objeto invocado
     */
    public function invoke($command, $arguments = null)
    {
        $namespaceCommand = $this->mountNamespaceCommand($command);

        if (!class_exists($namespaceCommand)) {
            throw new \InvalidArgumentException(sprintf('O Command %s, não foi localizada.', $namespaceCommand));
        }

        // invoca o command e retorna sua instancia
        return call_user_func_array(array(new $namespaceCommand, 'run'), $arguments);
    }

    /**
     * Método responsável por montar o namespace com base no nome de um command
     *
     * @access private
     *
     * @param String $command nome do commando
     *
     * @return String namespace do command
     */
    private function mountNamespaceCommand($command)
    {
        return self::NAMESPACE_CLASS . ucfirst($command);
    }
}
