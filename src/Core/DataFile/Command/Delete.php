<?php

/**
 * Classe responsável excluir um registro no arquivo
 *
 * @package Commbox\Core\DataFile\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Command;

use Commbox\Core\DataFile\Endpoint\File;
use Commbox\Core\DataFile\Contract\Command\Command;
use SplTempFileObject;

class Delete extends File implements Command
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    /**
     * @see Commbox\Core\DataFile\Contract\Command\Command::run
     */
    public function run($params)
    {
        if ($this->getSize() <=  0) {
            return true;
        }

        $indexDelete = (int) $params;

        $temp = new SplTempFileObject();

        foreach ($this as $line) {
            if (!$this->valid()) {
                continue;
            }

            $lineArray  = $this->convert($line);
            $id         = (int) $lineArray['id'];

            if ($id != $indexDelete) {
                $temp->fwrite($this->current());
            }
        }

        $this->ftruncate(0);

        foreach ($temp as $line) {
            $this->fwrite($line);
        }

        return true;
    }
}
