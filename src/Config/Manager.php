<?php

namespace PrettyBx\Support\Config;

use PrettyBx\Support\Contracts\ConfigurationContract;
use Bitrix\Main\Config\Configuration;

class Manager implements ConfigurationContract
{
    /**
     * @var Configuration $bxConfig
     */
    protected $bxConfig;

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        return $this->getBxConfig()->get($key);
    }

    /**
     * getBxConfig.
     *
     * @access	protected
     * @return	Configuration
     */
    protected function getBxConfig(): Configuration
    {
        if (empty($this->bxConfig)) {
            $this->bxConfig = Configuration::getInstance();
        }

        return $this->bxConfig;
    }
}
