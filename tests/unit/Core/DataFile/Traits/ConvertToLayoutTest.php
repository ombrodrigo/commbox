<?php

namespace Commbox\Tests\Core\DataFile\Traits;

use PHPUnit\Framework\TestCase;

class ConvertToLayoutTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;
    use \Commbox\Core\DataFile\Traits\ConvertToLayout;

    public function testConvert()
    {
        $line = '1       Rodrigo Conceicao de Araujo                                     aaa123  19/01/1985Porto Alegre                    000.000.000-00Pai Conceicao de Araujo                                         Mae Conceicao de Araujo                                         Isso e um teste 2017-03-10 02:20:16 ';
        $lineArray = array(
            'id' => '1',
            'nome' => 'Rodrigo Conceicao de Araujo',
            'senha' => 'aaa123',
            'dataNascimento' => '19/01/1985',
            'cidade' => 'Porto Alegre',
            'cpf' => '000.000.000-00',
            'pai' => 'Pai Conceicao de Araujo',
            'mae' => 'Mae Conceicao de Araujo',
            'observacao' => 'Isso e um teste 2017-03-10 02:20:16'
        );

        $result = $this->convert($line);
        $this->assertInternalType('array', $result);

        foreach ($result as $key => $value) {
            $this->assertTrue(array_key_exists($key, $lineArray));
            $this->assertEquals($lineArray[$key], $value);
        }
    }
}
