<?php

namespace Commbox\Tests\Core\DataFile\Traits;

use PHPUnit\Framework\TestCase;

class IntegrityTest extends TestCase
{
    use \Commbox\Core\DataFile\Traits\Integrity;

    public function testGetValidId()
    {
        $testNextValidId = new \SplFileObject('public/data/sequence/pessoa.txt', 'a+');
        $nextValidId = 1 + (int) $testNextValidId->current();

        $validId = $this->getValidId('pessoa');

        $this->assertTrue(is_int($validId));
        $this->assertEquals($nextValidId, $validId);
    }
}
