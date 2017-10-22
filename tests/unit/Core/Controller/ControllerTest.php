<?php

namespace Commbox\Tests\Core\Controllers;

use PHPUnit\Framework\TestCase;
use Commbox\Core\Controllers\Controller;
use Commbox\Controllers\ContaCaracter;

class ControllerTest extends TestCase
{
    private $object = null;

    public function setUp()
    {
        $this->object = new ContaCaracter();
    }

    public function testInit()
    {
        $this->assertInstanceOf('\\Commbox\\Controllers\\ContaCaracter', ContaCaracter::init());
    }
}
