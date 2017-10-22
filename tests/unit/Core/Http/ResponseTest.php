<?php

namespace Commbox\Tests\Core\Http;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Http\Response;

class ResponseTest extends TestCase
{
    private $object = null;

    public function setUp()
    {
        $this->object = new Response();
    }

    public function testResponse()
    {
        $this->object->setResponse('aaa', '123');

        $reflectionProperty = new \ReflectionProperty('\\Commbox\\Core\\Http\\Response', 'responseData');
        $reflectionProperty->setAccessible(true);
        $response = $reflectionProperty->getValue($this->object);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('aaa', $response);
        $this->assertEquals('123', $response['aaa']);
    }

    public function testResponseArray()
    {
        $this->object->setResponseArray(array('aaa' => '123', 'bbb' => '456'));
        $reflectionProperty = new \ReflectionProperty('\\Commbox\\Core\\Http\\Response', 'responseData');
        $reflectionProperty->setAccessible(true);
        $response = $reflectionProperty->getValue($this->object);
        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('bbb', $response);
        $this->assertEquals('456', $response['bbb']);
    }

    public function testSetPage()
    {
        $this->object->setPage('abcde');
        $reflectionProperty = new \ReflectionProperty('\\Commbox\\Core\\Http\\Response', 'pageRender');
        $reflectionProperty->setAccessible(true);
        $this->assertEquals('abcde.php', $reflectionProperty->getValue($this->object));
    }

    public function testSetPageAndData()
    {
        $this->object->setPage('abcde', array('aaa' => '123', 'bbb' => '456', 'ccc' => '789'));

        $reflectionPropertyPage = new \ReflectionProperty('\\Commbox\\Core\\Http\\Response', 'pageRender');
        $reflectionPropertyPage->setAccessible(true);
        $this->assertEquals('abcde.php', $reflectionPropertyPage->getValue($this->object));

        $reflectionPropertyResponseData = new \ReflectionProperty('\\Commbox\\Core\\Http\\Response', 'responseData');
        $reflectionPropertyResponseData->setAccessible(true);
        $responseData = $reflectionPropertyResponseData->getValue($this->object);
        $this->assertInternalType('array', $responseData);
        $this->assertArrayHasKey('ccc', $responseData);
        $this->assertEquals('789', $responseData['ccc']);
    }

    public function testRender()
    {
        $this->object->setPage(SRC_PATH . '/Views/main/menu');

        $renderPage = null;

        ob_start();
            $this->object->render();
            $renderPage = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(file_get_contents(SRC_PATH . '/Views/main/menu.php'), $renderPage);
    }
}
