<?php

namespace Commbox\Tests\Core\DataFile\Command;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\Command\Update;
use Commbox\Core\DataFile\Command\Find;
use Commbox\Core\DataFile\Command\Insert;

class UpdateTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\Write;

    private $object = null;

    public function dataProvider()
    {
        return
            array(
                array(
                    array(
                        'nome' => date('Y-m-d H:i:s'),
                        'senha' => 'aaa123',
                        'dataNascimento' => '19/01/1985',
                        'cidade' => 'Porto Alegre',
                        'cpf' => '000.000.000-00',
                        'pai' => 'Pai Conceicao de Araujo',
                        'mae' => 'Mae Conceicao de Araujo',
                        'observacao' => 'Isso e um teste ' . date('Y-m-d H:i:s')
                    )
                )
            );
    }

    public function setUp()
    {
        $this->object = new Update();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Contract\\Command\\Command', $this->object);
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Endpoint\\File', $this->object);
    }

    private function insertToUpdate($data)
    {
        $insert = new Insert();
        return $insert->run($data);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRun($post)
    {
        $id = $this->insertToUpdate($post);
        $find = new Find();
        $resultFind = $find->run($id);
        $dataUpdate = $resultFind;
        $dataUpdate['nome'] = 'UPDATE: ' . date('Y-m-d H:i:s');

        $this->object->run($dataUpdate);

        $find = new Find();
        $resultFind = $find->run($dataUpdate['id']);

        $this->assertInternalType('array', $resultFind);

        foreach ($dataUpdate as $key => $value) {
            $this->assertArrayHasKey($key, $resultFind);
            $this->assertEquals($value, $resultFind[$key]);
        }
    }
}
