<?php

namespace PrettyBx\Support\Tests;

use PrettyBx\Support\Base\AbstractServiceProvider;

class AppTest extends TestCase
{
    public function testApplicationIsBootstrapped()
    {
        $this->assertTrue(class_exists(AbstractServiceProvider::class));
    }
}
