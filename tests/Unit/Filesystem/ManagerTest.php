<?php

namespace PrettyBx\Support\Tests\Base;

use PrettyBx\Support\Tests\TestCase;
use PrettyBx\Support\Filesystem\Manager;

class ManagerTest extends TestCase
{
    public function testFileFunctions()
    {
        $manager = new Manager();

        $data = 'test content';

        $filename = $manager->getTempDir() . DIRECTORY_SEPARATOR . 'testfile.txt';

        $this->assertFalse($manager->exists($filename));

        $manager->touch($filename);

        $this->assertTrue($manager->exists($filename));

        $manager->putContents($filename, $data);

        $this->assertEquals($data, $manager->getContents($filename));

        $newname = __DIR__ . DIRECTORY_SEPARATOR . 'testfile_new.txt';

        $manager->rename($filename, $newname);

        $this->assertFalse($manager->exists($filename));
        $this->assertTrue($manager->exists($newname));

        $this->assertEquals($data, $manager->getContents($newname));
    }
}
