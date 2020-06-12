<?php

declare(strict_types=1);

namespace PrettyBx\Support\Providers;

use PrettyBx\Support\Contracts\ServiceProviderContract;
use PrettyBx\Support\Contracts\ConfigurationContract;
use PrettyBx\Support\Config\Manager as ConfigManager;

abstract class AbstractEventServiceProvider implements ServiceProviderContract
{
    /**
     * @var array $events
     */
    protected array $events = [];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        if (! empty($this->events)) {
            $this->bindEvents();
        }
    }

    /**
     * Binds handlers to events
     *
     * @access	protected
     * @return	void
     */
    protected function bindEvents(): void
    {
        $manager = container()->make('\Bitrix\Main\EventManager');

        foreach ($this->events as $event) {
            $manager->addEventHandler($event['module'], $event['event'], $event['handler'], $event['sort']);
        }
    }
}
