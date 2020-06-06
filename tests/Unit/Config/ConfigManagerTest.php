<?php

namespace PrettyBx\Support\Tests\Config;

use PrettyBx\Support\Tests\TestCase;
use PrettyBx\Support\Config\Manager;

class ConfigManagerTest extends TestCase
{
    protected $manager;

    public function setUp(): void
    {
        $this->manager = \Mockery::mock(Manager::class . '[getBxConfig]')
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $this->manager->shouldReceive('getBxConfig')->andReturn($this->getBxConfig());
    }

    /**
     * @test
     */
    public function manager_returns_correct_array()
    {
        $expected = [
            'subkeyA' => 'valueA',
            'subkeyB' => 'valueB',
        ];

        $this->assertEquals($expected, $this->manager->get('key'));
    }

    /**
     * @test
     */
    public function manager_returns_correct_array_value()
    {
        $this->assertEquals('valueA', $this->manager->get('key.subkeyA'));
    }

    /**
     * @test
     */
    public function manager_returns_null_if_no_value_found()
    {
        $this->assertEquals('', $this->manager->get('key.non-existent-subkey'));
    }

    protected function getBxConfig()
    {
        return new class() {
            public function get($key)
            {
                $config = [
                    'key' => [
                        'subkeyA' => 'valueA',
                        'subkeyB' => 'valueB',
                    ],
                ];

                return $config[$key];
            }
        };
    }
}
