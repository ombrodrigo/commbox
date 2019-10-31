<?php

namespace Commbox\Tests\Core\Scanner;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Scanner\Scanner;
use Commbox\Core\Scanner\File;
use Commbox\Core\Scanner\Text;

class ScannerTest extends TestCase
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
        $this->object = new Scanner();
    }

    /**
     * @dataProvider fileProvider
     */
    public function testCountInFile($files)
    {
        $_FILES = $files;

        $caseSensitive = $this->object->count(new File(), 'u', true);
        $this->assertEquals('u', $caseSensitive['letter']);
        $this->assertEquals(264, $caseSensitive['result']);

        $caseInsensitive  = $this->object->count(new File(), 'u', false);
        $this->assertEquals('u', $caseInsensitive['letter']);
        $this->assertEquals(266, $caseInsensitive['result']);
    }

    /**
     * @dataProvider postProvider
     */
    public function testCountInText($post)
    {
        $_POST = $post;

        $caseSensitive = $this->object->count(new Text(), 'a', true);
        $this->assertEquals('a', $caseSensitive['letter']);
        $this->assertEquals(19, $caseSensitive['result']);

        $caseInsensitive  = $this->object->count(new Text(), 'a', false);
        $this->assertEquals('a', $caseInsensitive['letter']);
        $this->assertEquals(20, $caseInsensitive['result']);
    }
}
