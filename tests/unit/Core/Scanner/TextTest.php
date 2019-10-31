<?php

namespace Commbox\Tests\Core\Scanner;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Scanner\Text;

class TextTest extends TestCase
{
    public $object = null;

    public function postProvider()
    {
        return
            array(
                array(
                    array(
                        'letterInText' => 'Mussum Ipsum, cacilds vidis litro abertis.
                        Quem num gosta di mé, boa gente num é. Mais vale um bebadis conhecidiss, que um alcoolatra anonimiss.
                        A ordem dos tratores não altera o pão duris Si u mundo tá muito paradis?
                        Toma um mé que o mundo vai girarzis!'
                    )
                )
            );
    }

    public function setUp()
    {
        $this->object = new Text();
    }

    /**
     * @dataProvider postProvider
     */
    public function testValidate($post)
    {
        $reflectionMethod = new \ReflectionMethod('Commbox\\Core\\Scanner\\Text', 'validate');
        $reflectionMethod->setAccessible(true);

        unset($_POST);
        $this->assertFalse($reflectionMethod->invoke($this->object));
        $_POST = $post;
        $this->assertTrue($reflectionMethod->invoke($this->object));
    }

    /**
     * @dataProvider postProvider
     */
    public function testGetContent($post)
    {
        $_POST = $post;

        $reflectionMethod = new \ReflectionMethod('Commbox\\Core\\Scanner\\Text', 'getContent');
        $reflectionMethod->setAccessible(true);

        $contentPost = $post['letterInText'];
        $this->assertEquals($contentPost, $reflectionMethod->invoke($this->object));
    }

    /**
     * @expectedException Exception
     */
    public function testCountException()
    {
        $_POST = null;
        $this->object->count('u', true);
    }

    /**
     * @dataProvider postProvider
     *
     */
    public function testCountCaseSensitive($post)
    {
        $_POST = $post;
        $result = $this->object->count('u', true);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('letter', $result);
        $this->assertArrayHasKey('result', $result);

        $this->assertEquals('u', $result['letter']);
        $this->assertEquals(16, $result['result']);

        $result  = $this->object->count('a', true);
        $this->assertEquals('a', $result['letter']);
        $this->assertEquals(19, $result['result']);
    }

    /**
     * @dataProvider postProvider
     */
    public function testCountCaseInsensitive($post)
    {
        $_POST = $post;

        $result = $this->object->count('u', false);
        $this->assertEquals('u', $result['letter']);
        $this->assertEquals(16, $result['result']);

        $result = $this->object->count('a', false);
        $this->assertEquals('a', $result['letter']);
        $this->assertEquals(20, $result['result']);
    }

    /**
     * @dataProvider postProvider
     */
    public function testCountPlusLetters($post)
    {
        $_POST = $post;

        $result = $this->object->count('mé', true);
        $this->assertEquals('mé', $result['letter']);
        $this->assertEquals(2, $result['result']);

        $result = $this->object->count('duris', true);
        $this->assertEquals('duris', $result['letter']);
        $this->assertEquals(1, $result['result']);

        $result = $this->object->count('Quem', false);
        $this->assertEquals('Quem', $result['letter']);
        $this->assertEquals(1, $result['result']);

        $result = $this->object->count('Si u mundo tá muito paradis?', true);
        $this->assertEquals('Si u mundo tá muito paradis?', $result['letter']);
        $this->assertEquals(1, $result['result']);
    }
}
