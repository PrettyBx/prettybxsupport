<?php

declare(strict_types=1);

namespace PrettyBx\Support\Providers;

use PrettyBx\Support\Base\AbstractServiceProvider;

class BitrixMainProvider extends AbstractServiceProvider
{
    /**
     * @var array $singletons
     */
    protected $singletons = [
        '\Bitrix\Main\Loader',
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        parent::register();

        $this->initGlobalObjects();
    }

    /**
     * Initializes global variables
     *
     * @access	protected
     * @return	void
     */
    protected function initGlobalObjects(): void
    {
        container()->singleton('CMain', function () {
            if (empty($GLOBALS['APPLICATION'])) {
                throw new \RuntimeException('Bitrix is not initialized');
            }

            return $GLOBALS['APPLICATION'];
        });

        container()->singleton('CUser', function () {
            if (empty($GLOBALS['USER'])) {
                throw new \RuntimeException('Bitrix is not initialized');
            }

            return $GLOBALS['USER'];
        });

        container()->singleton('\Bitrix\Main\Application', function () {
            return \Bitrix\Main\Application::getInstance();
        });
    }
}
