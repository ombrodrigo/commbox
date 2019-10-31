<?php

namespace Commbox\Tests\Core\Http;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Http\Request;

class RequestTest extends TestCase
{
    private $object = null;

    public function setUp()
    {
        $this->object = new Request();
    }

    public function setRequests()
    {
        $_GET['get'] = '123456789';
        $_POST['post'] = '123456789';
        $_REQUEST['request'] = '123456789';
        $_FILES['file'] = array(
            'name' => 'file_test.txt',
            'type' => 'text/plain',
            'size' => 542,
            'tmp_name' => TEST_PATH . '/uploads/file_test.txt',
            'error' => 0
        );
    }

    public function unsetRequests()
    {
        unset($_GET);
        unset($_POST);
        unset($_FILES);
        unset($_REQUEST);
    }

    public function testRequestsEmpty()
    {
        $this->unsetRequests();
        $this->assertEmpty($this->object->getGet());
        $this->assertEmpty($this->object->getPost());
        $this->assertEmpty($this->object->getFile());
        $this->assertEmpty($this->object->getRequest());
    }

    public function testRequests()
    {
        $this->setRequests();
        $this->assertNotEmpty($this->object->getGet());
        $this->assertNotEmpty($this->object->getPost());
        $this->assertNotEmpty($this->object->getFile());
        $this->assertNotEmpty($this->object->getRequest());
    }

    public function testRoutes()
    {
        $this->unsetRequests();

        # test Uri
        $_GET['contaCaracter/processar'] = '';
        $this->assertEquals('contaCaracter/processar', $this->object->getUri());

        # test Controller
        $this->assertEquals('contaCaracter', $this->object->getController());

        # test Action
        $this->assertEquals('processar', $this->object->getAction());

        # test checkRouteRunCallback
        $response = null;
        $this->object->checkRouteRunCallback('contaCaracter/processar', function() use (&$response) {
            $response = 'tudo certo';
        });
        $this->assertEquals('tudo certo', $response);

        # test routeGet
        $responseRouteGet = null;
        $this->object->routeGet('contaCaracter/processar', function() use (&$responseRouteGet) {
            $responseRouteGet = 'sou um get';
        });
        $this->assertEquals('sou um get', $responseRouteGet);

        # test routePost
        $_POST['post'] = '1234567890';
        $responseRoutePost = null;
        $this->object->routePost('contaCaracter/processar', function() use (&$responseRoutePost) {
            $responseRoutePost = 'sou um post';
        });
        $this->assertEquals('sou um post', $responseRoutePost);

        # test routeGet empty
        $this->assertEmpty($this->object->routeGet('contaCaracter', ''));

        # test routePost empty
        $_POST = array();
        $this->assertEmpty($this->object->routePost('contaPost', ''));
    }
}
