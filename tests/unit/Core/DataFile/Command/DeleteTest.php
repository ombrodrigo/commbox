<?php

namespace Commbox\Tests\Core\DataFile\Command;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\Command\Delete;
use Commbox\Core\DataFile\Command\Insert;

class DeleteTest extends TestCase
{
    private $object = null;

    public function setUp()
    {
        $this->object = new Delete();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Contract\\Command\\Command', $this->object);
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Endpoint\\File', $this->object);
    }

    private function insertToDelete()
    {
        $insert = new Insert();

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

        return $insert->run($data);
    }

    public function testEmptyFile()
    {
        unlink('public/data/pessoa.txt');
        $handler = fopen('public/data/pessoa.txt', 'w+');
        fclose($handler);
        $this->assertTrue($this->object->run('111'));
    }

    /**
     * @depends testEmptyFile
     */
    public function testRun()
    {
        $id = $this->insertToDelete();
        $this->assertTrue($this->object->run($id));
    }
}
