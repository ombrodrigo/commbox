<?php

namespace Commbox\Tests\Core\DataFile\Command;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\Command\Insert;

class InsertTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;

    private $object     = null;

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
                        'pai'               => 'Pai Conceição de Araujo',
                        'mae'               => 'Mãe Conceição de Araujo',
                        'observacao'        => 'Isso é um teste ' . date('Y-m-d H:i:s') // necessário para testar se o insert foi correto
                    )
                )
            );
    }

    public function setUp()
    {
        $this->object = new Insert();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Contract\\Command\\Command', $this->object);
        $this->assertInstanceOf('Commbox\\Core\\DataFile\\Endpoint\\File', $this->object);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testRun($post)
    {
        $testNextValidId    = new \SplFileObject('public/data/sequence/pessoa.txt', 'a+');
        $nextValidId        = 1 + (int) $testNextValidId->current();

        $this->assertEquals($nextValidId, $this->object->run($post));
    }
}
