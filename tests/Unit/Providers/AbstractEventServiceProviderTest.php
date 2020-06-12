<?php

namespace PrettyBx\Support\Tests\Base;

use PrettyBx\Support\Tests\TestCase;
use PrettyBx\Support\Providers\AbstractEventServiceProvider;

class AbstractEventServiceProviderTest extends TestCase
{
    public function testEventBindings()
    {
        $provider = new class extends AbstractEventServiceProvider {
            protected array $events = [
                [
                    'module' => 'tasks', 
                    'event' => 'OnTaskUpdate',
                    'handler' => "event_handler_function",
                    'sort' => 100,
                ]
            ];
        };

        $eventManager = $this->getMockBuilder('\Bitrix\Main\EventManager')
            ->setMethods(['addEventHandler'])
            ->getMock();
        
        $eventManager->expects($this->once())
            ->method('addEventHandler');

        container()->bind('\Bitrix\Main\EventManager', function () use ($eventManager) {
            return $eventManager;
        });

        $provider->register();
    }
}
