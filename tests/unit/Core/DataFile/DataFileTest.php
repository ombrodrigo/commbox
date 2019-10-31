<?php

namespace Commbox\Tests\Core\DataFile;

use PHPUnit\Framework\TestCase;
use Commbox\Core\DataFile\DataFile;

class DataFileTest extends TestCase
{
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
        $this->object = new DataFile();
    }

    /**
     * @expectedException Exception
     */
    public function testInvokeCommandException()
    {
        $this->object->inserts();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInvokeCommand($post)
    {
        $testNextValidId = new \SplFileObject('public/data/sequence/pessoa.txt', 'a+');
        $nextValidId = 1 + (int) $testNextValidId->current();

        /**
         * COMMAND INSERT
         */
        $id = $this->object->insert($post);
        $this->assertTrue(is_int($id));
        $this->assertEquals($nextValidId, $id);

        /**
         * COMMAND FIND
         */
        // captura pelo id
        $find = $this->object->find($id);

        // compara os registro do find com o post
        $this->assertInternalType('array', $find);
        foreach ($post as $key => $value) {
            $this->assertArrayHasKey($key, $find);
            $this->assertEquals($value, $find[$key]);
        }

        /**
         * COMMAND FINDALL
         */
        $findAll = $this->object->findAll(null);
        $this->assertInternalType('array', $findAll);

        /**
         * COMMAND SEARCH
         */
        // realizamos pesquisa pelo nome (encontra)
        $search = $this->object->search(array('key' => 'nome', 'value' => $post['nome']));
        $this->assertInternalType('array', $search);
        $searchCurrent = current($search);

        // compara os registro do search com o post
        foreach ($post as $key => $value) {
            $this->assertArrayHasKey($key, $searchCurrent);
            $this->assertEquals($value, $searchCurrent[$key]);
        }

        /**
        * COMMAND UPDATE
        */
        // atualiza o nome da mae
        $post['mae'] = date('Y-m-d H:i:s');
        $arrayUpdate = array_merge(array('id' => $id), $post);
        $this->assertTrue($this->object->update($arrayUpdate));

        // realiza pesquisa pelo nome da mae (encontra)
        $search = $this->object->search(array('key' => 'mae', 'value' => $post['mae']));
        $this->assertInternalType('array', $search);
        $searchCurrent  = current($search);

        // compara os registro do search com o post
        foreach ($post as $key => $value) {
            $this->assertArrayHasKey($key, $searchCurrent);
            $this->assertEquals($value, $searchCurrent[$key]);
        }

        /**
         * COMMAND DELETE
         */
        $this->assertTrue($this->object->delete($id));

        $search = $this->object->search(array('key' => 'mae', 'value' => $post['mae']));
        $this->assertEmpty($search);
    }
}
