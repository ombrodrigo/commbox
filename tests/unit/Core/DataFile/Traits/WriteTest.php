<?php

namespace Commbox\Tests\Core\DataFile\Traits;

use PHPUnit\Framework\TestCase;

class WriteTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\Write;

    const DATA_FILE = 'data/pessoa.txt';
    protected $resource = null;

    public function setUp()
    {
        $this->resource = new \SplFileObject(sprintf('%s/%s', TEST_PATH, self::DATA_FILE), 'a+');
    }

    public function testStart()
    {
        $this->start();
        $this->assertInternalType('array', $this->getRecords());
    }

    public function testAdd()
    {
        $nome   = 'Rodrigo Conceição de Araujo';
        $senha  = 'aaa123';

        $this->add($nome, $this->nome['size']);
        $this->add($senha, $this->senha['size']);

        $records = $this->getRecords();
        $this->assertEquals(2, count($records));

        $current = current($records);
        $this->assertEquals(str_pad($this->removeAccent($nome), $this->nome['size'], " ", STR_PAD_RIGHT), $current);
        $this->assertEquals($this->nome['size'], strlen($current));

        $end = end($records);
        $this->assertEquals(str_pad($senha, $this->senha['size'], " ", STR_PAD_RIGHT), $end);
        $this->assertEquals($this->senha['size'], strlen($end));

        $inLine = $this->inLine("");
        $test = 'Rodrigo Conceicao de Araujo                                     aaa123  ';

        $this->assertEquals(72, strlen($inLine));
        $this->assertEquals($test, $inLine);
    }

    public function testFinish()
    {
        $nome   = 'Rodrigo Conceição de Araujo';
        $senha  = 'aaa123';
        $test   = 'Rodrigo Conceicao de Araujo                                     aaa123  ';

        $this->start();

        $this->add($nome, $this->nome['size']);
        $this->add($senha, $this->senha['size']);

        $this->finish();

        $handler = new \SplFileObject(sprintf('%s/%s', TEST_PATH, self::DATA_FILE), 'a+');

        while (!$handler->eof()) {
            $line = str_replace(PHP_EOL, "", $handler->fgets());
            $this->assertEquals(72, strlen($line));
            $this->assertEquals($test, $line);
            break;
        }
    }
}
