<?php

/**
 * Classe responsável retornar itens do arquivo com base em uma pesquisa
 *
 * @package Commbox\Core\DataFile\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Command;

use Commbox\Core\DataFile\Endpoint\File;
use Commbox\Core\DataFile\Contract\Command\Command;

class Search extends File implements Command
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;
    use \Commbox\Core\DataFile\Traits\Write;

    /**
     * @see Commbox\Core\DataFile\Contract\Command\Command::run
     */
    public function run($params)
    {
        $keySearch    = $params['key'];
        $valueSearch  = $this->removeAccent($params['value']);

        $records = array();

        if ($this->getSize() <= 0) {
            return $records;
        }

        foreach ($this as $line) {
            if (!$this->valid()) {
                continue;
            }

            #@TODO criar classe para tratar string. "removeAccent ACOPLAMENTO"
            $lineArray = $this->convert($this->removeAccent($line));

            $valueKeyInLineArray = $lineArray[$keySearch];

            if (substr_count(strtolower($valueKeyInLineArray), strtolower($valueSearch)) > 0) {
                $records[$this->key()] = $lineArray;
            }
        }

        return !empty($records) ? $records : null;
    }
}
