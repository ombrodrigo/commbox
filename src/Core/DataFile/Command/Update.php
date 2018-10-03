<?php

/**
 * Classe responsável atualizar um registro no arquivo
 *
 * @package Commbox\Core\DataFile\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Command;

use Commbox\Core\DataFile\Endpoint\File;
use Commbox\Core\DataFile\Contract\Command\Command;
use SplTempFileObject;

class Update extends File implements Command
{
    use \Commbox\Core\DataFile\Traits\Write;
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    /**
     * @see Commbox\Core\DataFile\Contract\Command\Command::run
     */
    public function run($params)
    {
        $keyUpdate = (int) $params['id'];

        foreach ($params as $attribute => $value) {
            $attributeArray = $this->$attribute;
            $this->add($value, $attributeArray['size']);
        }

        $lineUpdate = $this->inLine(PHP_EOL);

        $temp = new SplTempFileObject();

        foreach ($this as $line) {
            if (!$this->valid()) {
                continue;
            }

            $lineArray  = $this->convert($line);
            $id         = (int) $lineArray['id'];

            if ($id == $keyUpdate) {
                $temp->fwrite($lineUpdate);
                continue;
            }

            $temp->fwrite($line);
        }

        $this->ftruncate(0);

        foreach ($temp as $line) {
            $this->fwrite($line);
        }

        return true;
    }
}
