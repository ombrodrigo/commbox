<?php

namespace Commbox\Tests\Core\DataFile\Command;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\Command\Find;
use Commbox\Core\DataFile\Command\Insert;

class FindTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    private $object = null;

    public function dataProvider()
    {
        return
            array(
                array(
                    array(
                        'nome'              => date('Y-m-d H:i:s'),
                        'senha'             => 'aaa123',
                        'dataNascimento'    => '19/01/1985',
                        'cidade'            => 'Porto Alegre',
                        'cpf'               => '000.000.000-00',
                        'pai'               => 'Pai Conceicao de Araujo',
                        'mae'               => 'Mae Conceicao de Araujo',
                        'observacao'        => 'Isso é um teste ' . date('Y-m-d H:i:s')
                    )
                )
            );
    }

    public function setUp()
    {
        $this->object = new Find();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Contract\\Command\\Command', $this->object);
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Endpoint\\File', $this->object);
    }

    private function insertToFind()
    {
        $insert = new Insert();
        $data = current(current($this->dataProvider()));
        return $insert->run($data);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRun($post)
    {
        $id   = $this->insertToFind();
        $find = $this->object->run($id);

        $this->assertInternalType('array', $find);

        $this->assertArrayHasKey('nome', $find);
        $this->assertArrayHasKey('senha', $find);
        $this->assertArrayHasKey('dataNascimento', $find);
        $this->assertArrayHasKey('cidade', $find);
        $this->assertArrayHasKey('cpf', $find);
        $this->assertArrayHasKey('pai', $find);
        $this->assertArrayHasKey('mae', $find);
        $this->assertArrayHasKey('observacao', $find);

        $this->assertEquals($post['senha'], $find['senha']);
        $this->assertEquals($post['dataNascimento'], $find['dataNascimento']);
        $this->assertEquals($post['cidade'], $find['cidade']);
        $this->assertEquals($post['cpf'], $find['cpf']);
        $this->assertEquals($post['pai'], $find['pai']);
        $this->assertEquals($post['mae'], $find['mae']);
    }
}
