<?php

namespace Commbox\Tests\Core\Scanner;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Scanner\File;

class FileTest extends TestCase
{
    public $object = null;

    public function fileProvider()
    {
        return
            array(
                array(
                    array(
                        'letterInFile' => array(
                            'name' => 'file_test.txt',
                            'type' => 'text/plain',
                            'size' => 542,
                            'tmp_name' => TEST_PATH . '/uploads/file_test.txt',
                            'error' => 0
                        )
                    )
                )
            );
    }

    public function setUp()
    {
        $this->object = new File();
    }

    /**
     * @dataProvider fileProvider
     */
    public function testValidate($files)
    {
        $reflectionMethod  = new \ReflectionMethod('Commbox\\Core\\Scanner\\File', 'validate');
        $reflectionMethod->setAccessible(true);

        unset($_FILES);
        $this->assertFalse($reflectionMethod->invoke($this->object));
        $_FILES = $files;
        $this->assertTrue($reflectionMethod->invoke($this->object));
    }

    /**
     * @dataProvider fileProvider
     */
    public function testGetContent($files)
    {
        $_FILES = $files;

        $reflectionMethod  = new \ReflectionMethod('Commbox\\Core\\Scanner\\File', 'getContent');
        $reflectionMethod->setAccessible(true);

        $contentFile = file_get_contents($files['letterInFile']['tmp_name']);
        $this->assertEquals($contentFile, $reflectionMethod->invoke($this->object));
    }

    /**
     * @expectedException Exception
     */
    public function testCountException()
    {
        $_FILES = null;
        $this->object->count('u', true);
    }

    /**
     * @dataProvider fileProvider
     */
    public function testCountCaseSensitive($files)
    {
        $_FILES = $files;
        $result = $this->object->count('u', true);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('letter', $result);
        $this->assertArrayHasKey('result', $result);

        $this->assertEquals('u', $result['letter']);
        $this->assertEquals(264, $result['result']);

        $result = $this->object->count('a', true);
        $this->assertEquals('a', $result['letter']);
        $this->assertEquals(356, $result['result']);
    }

    /**
     * @dataProvider fileProvider
     */
    public function testCountCaseInsensitive($files)
    {
        $_FILES = $files;

        $result = $this->object->count('u', false);
        $this->assertEquals('u', $result['letter']);
        $this->assertEquals(266, $result['result']);

        $result = $this->object->count('a', false);
        $this->assertEquals('a', $result['letter']);
        $this->assertEquals(366, $result['result']);
    }

    /**
     * @dataProvider fileProvider
     */
    public function testCountPlusLetters($files)
    {
        $_FILES = $files;

        $result = $this->object->count('vê', true);
        $this->assertEquals('vê', $result['letter']);
        $this->assertEquals(4, $result['result']);

        $result = $this->object->count('bibendum', true);
        $this->assertEquals('bibendum', $result['letter']);
        $this->assertEquals(2, $result['result']);

        $result = $this->object->count('Quem', false);
        $this->assertEquals('Quem', $result['letter']);
        $this->assertEquals(8, $result['result']);

        $result = $this->object->count('Si u mundo tá muito paradis?', true);
        $this->assertEquals('Si u mundo tá muito paradis?', $result['letter']);
        $this->assertEquals(2, $result['result']);
    }
}
