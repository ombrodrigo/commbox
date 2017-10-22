<?php

namespace Commbox\Tests\Core\DataFile\Traits;

use PHPUnit\Framework\TestCase;

class LayoutTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Layout;

    public function attributProvider()
    {
        return
            array(
                array(
                    'attribute' => 'id',
                    'start'     => 0,
                    'size'      => 8
                ),
                array(
                    'attribute' => 'nome',
                    'start'     => 8,
                    'size'      => 64
                ),
                array(
                    'attribute' => 'senha',
                    'start'     => 72,
                    'size'      => 8
                ),
                array(
                    'attribute' => 'dataNascimento',
                    'start'     => 80,
                    'size'      => 10
                ),
                array(
                    'attribute' => 'cidade',
                    'start'     => 90,
                    'size'      => 32
                ),
                array(
                    'attribute' => 'cpf',
                    'start'     => 122,
                    'size'      => 14
                ),
                array(
                    'attribute' => 'pai',
                    'start'     => 136,
                    'size'      => 64
                ),
                array(
                    'attribute' => 'mae',
                    'start'     => 200,
                    'size'      => 64
                ),
                array(
                    'attribute' => 'observacao',
                    'start'     => 264,
                    'size'      => 36
                )
            );
    }

    /**
     * @dataProvider attributProvider
     */
    public function testAttributes($attribute, $start, $size)
    {
        $this->assertEquals($start, $this->$attribute['start']);
        $this->assertEquals($size, $this->$attribute['size']);
    }

    public function testLineSize()
    {
        $this->assertEquals(300, $this->lineSize);
    }
}
