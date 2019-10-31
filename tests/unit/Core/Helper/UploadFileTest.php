<?php

namespace Commbox\Tests\Core\Helper;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Helper\UploadFile;

class UploadFileTest extends TestCase
{
    private $object = null;

    public function setUp()
    {
        $this->object = new UploadFile();
    }

    public function testMoutPath()
    {
        $this->assertEquals(
            'public/uploads/file_test.txt',
            $this->object->mountPath('file_test.txt')
        );
    }

    public function testSave()
    {
        $nameFile = 'file_test.txt';
        $from = TEST_PATH . '/uploads/file_test.txt';
        $this->assertTrue($this->object->save($from, $nameFile));
    }

    /**
     * @depends testSave
     */
    public function testDelete()
    {
        $this->assertTrue($this->object->delete('file_test.txt'));
    }
}
