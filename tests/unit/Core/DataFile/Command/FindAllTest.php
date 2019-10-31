<?php

namespace Commbox\Tests\Core\DataFile\Command;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\Command\FindAll;
use Commbox\Core\DataFile\Command\Find;
use Commbox\Core\DataFile\Command\Insert;

class FindAllTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    private $object = null;

    public function setUp()
    {
        $this->checkEmptyFile();
        $this->object = new FindAll();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Contract\\Command\\Command', $this->object);
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Endpoint\\File', $this->object);
    }

    private function checkEmptyFile()
    {
        $insert = new Insert();

        if ($insert->getSize() <= 0) {
            $data = array(
                'nome' => date('Y-m-d H:i:s'),
                'senha' => 'aaa123',
                'dataNascimento' => '19/01/1985',
                'cidade' => 'Porto Alegre',
                'cpf' => '000.000.000-00',
                'pai' => 'Pai Conceicao de Araujo',
                'mae' => 'Mae Conceicao de Araujo',
                'observacao' => 'Isso é um teste ' . date('Y-m-d H:i:s')
            );

            $insert->run($data);
        }
    }

    public function testEmptyFile()
    {
        unlink('public/data/pessoa.txt');
        $handler = fopen('public/data/pessoa.txt', 'w+');
        fclose($handler);
        $this->assertEmpty($this->object->run(''));
    }

    /**
     * @depends testEmptyFile
     */
    public function testRun()
    {
        $findAll = $this->object->run(null);

        if ($this->object->getSize() <= 0) {
            $this->assertNull($findAll);
            return true;
        }

        $this->assertInternalType('array', $findAll);
        $current = current($findAll);

        $find = new Find();
        $resultFind = $find->run($current['id']);

        $this->assertInternalType('array', $resultFind);

        foreach ($current as $key => $value) {
            $this->assertArrayHasKey($key, $resultFind);
            $this->assertEquals($value, $resultFind[$key]);
        }
    }
}
