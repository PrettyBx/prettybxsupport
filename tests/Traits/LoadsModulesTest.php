<?php

namespace PrettyBx\Support\Tests\Traits;

use PrettyBx\Support\Traits\LoadsModules;
use PrettyBx\Support\Tests\TestCase;

class LoadsModulesTest extends TestCase
{
    /**
     * @test
     */
    public function loader_is_successfully_loaded()
    {
        $expectedModule = 'iblock';

        $loader = $this->getLoader($expectedModule, true);

        $class = $this->getLoadingClass();

        $class->modules = [$expectedModule];

        $class->load();
    }

    /**
     * @test
     */
    public function excepetion_is_thrown_of_module_cant_be_loaded()
    {
        $expectedModule = 'iblock';

        $loader = $this->getLoader($expectedModule, false);

        $class = $this->getLoadingClass();

        $class->modules = [$expectedModule];

        $this->expectException(\RuntimeException::class);

        $class->load();
    }

    protected function getLoader(string $expectedModule, bool $expectedReturn)
    {
        $loader = $this->getMockBuilder('\Bitrix\Main\Loader')
            ->setMethods(['includeModule'])
            ->getMock();

        $loader->expects($this->once())
            ->method('includeModule')
            ->with($this->equalTo($expectedModule))
            ->willReturn($expectedReturn);

        container()->bind('\Bitrix\Main\Loader', function () use ($loader) {
            return $loader;
        });
    }

    protected function getLoadingClass()
    {
        return new class() {
            use LoadsModules;

            public $modules;

            public function load()
            {
                $this->loadModules();
            }
        };
    }
}
