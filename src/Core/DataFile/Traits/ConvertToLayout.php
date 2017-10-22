<?php

/**
 * Trait que converte uma linha do arquivo para o formato do layout
 *
 * @package Commbox\Core\DataFile\Traits
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Traits;

trait ConvertToLayout
{
    /**
     * Método responsável por converter uma linha do arquivo para o formato do layout
     *
     * @access protected
     *
     * @param String $line linha a ser convertida
     *
     * @return Array
     */
    protected function convert($line)
    {
        $layout = new \ReflectionClass('Commbox\\Core\\DataFile\\Traits\\Layout');
        $layout = $layout->getProperties(\ReflectionProperty::IS_PROTECTED);

        $records = array();

        foreach ($layout as $property) {
            $attrName = $property->name;

            if (!is_array($this->$attrName)) {
                continue;
            }

            list($start, $size) = array_values($this->$attrName);

            $records[$attrName] = trim(substr($line, $start, $size));
        }

        return $records;
    }
}
