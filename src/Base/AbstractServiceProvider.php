<?php

declare(strict_types=1);

namespace PrettyBx\Support\Base;

use PrettyBx\Support\Contracts\ServiceProviderContract;

abstract class AbstractServiceProvider implements ServiceProviderContract
{
    /**
     * @var array $singletons
     */
    protected $singletons = [];

    /**
     * @var \Illuminate\Container\Container $container
     */
    protected $container;

    public function __construct()
    {
        $this->container = container();

        $this->bindSinletons();
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {

    }

    /**
     * bindSinletons.
     *
     * @access	protected
     * @return	void
     */
    protected function bindSinletons(): void
    {
        foreach ($this->singletons as $id => $implementation) {
            if (is_string($id)) {
                $this->container->singleton($id, $implementation);
            } else {
                $this->container->singleton($implementation);
            }
        }
    }
}
