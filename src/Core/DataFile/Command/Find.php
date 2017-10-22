<?php

/**
 * Classe responsável retornar uma linha do arquivo a partir da pesquisa do numero da linha
 *
 * @package Commbox\Core\DataFile\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Command;

use Commbox\Core\DataFile\Endpoint\File;
use Commbox\Core\DataFile\Contract\Command\Command;

class Find extends File implements Command
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    /**
     * @see Commbox\Core\DataFile\Contract\Command\Command::run
     */
    public function run($params)
    {
        if ($this->getSize() <= 0) {
            return null;
        }

        $record = null;
        $key    = (int) $params;

        foreach ($this as $line) {
            if (!$this->valid()) {
                continue;
            }

            $lineArray  = $this->convert($line);
            $id         = (int) $lineArray['id'];

            if ($key == $id) {
                $record = $lineArray;
                break;
            }
        }

        return $record;
    }
}
