<?php

/**
 * Classe responsável retornar todos os itens do arquivo
 *
 * @package Commbox\Core\DataFile\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Command;

use Commbox\Core\DataFile\Endpoint\File;
use Commbox\Core\DataFile\Contract\Command\Command;

class FindAll extends File implements Command
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    /**
     * @see Commbox\Core\DataFile\Contract\Command\Command::run
     */
    public function run($params)
    {
        $records = array();

        if ($this->getSize() <= 0) {
            return $records;
        }

        foreach ($this as $line) {
            if (!$this->valid()) {
                continue;
            }

            $records[] = $this->convert($line);
        }

        return $records;
    }
}
