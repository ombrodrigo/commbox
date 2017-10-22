<?php

namespace Commbox\Tests\Core\DataFile\Endpoint;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\Endpoint\File;

class FileTest extends TestCase
{
    public function testConstruct()
    {
        $mock = $this->getMockForAbstractClass('Commbox\\Core\\DataFile\\Endpoint\\File');
        $this->assertEquals('pessoa.txt', $mock->getFilename());
    }
}
