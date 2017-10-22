<?php

/**
 * Classe responsável inserir um registro no arquivo
 *
 * @package Commbox\Core\DataFile\Command
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Command;

use Commbox\Core\DataFile\Endpoint\File;
use Commbox\Core\DataFile\Contract\Command\Command;

class Insert extends File implements Command
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\Write;
    use \Commbox\Core\DataFile\Traits\Integrity;

    /**
     * @see Commbox\Core\DataFile\Contract\Command\Command::run
     */
    public function run($params)
    {
        $this->start();

        $validId = $this->getValidId();
        $params = array_merge(array('id' => $validId), $params);

        foreach ($params as $attribute => $value) {
            $attributeArray = $this->$attribute;
            $this->add($value, $attributeArray['size']);
        }

        $this->finish();

        return (int) $validId;
    }
}
