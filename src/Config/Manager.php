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
        $value = $this->getBxConfig()->get($key);
        
        if (! empty($value)) {
            return $value;
        }

        $keyPath = explode('.', $key);

        $root = $this->getBxConfig()->get($keyPath[0]);

        if (empty($root) || ! is_array($root)) {
            return '';
        }

        $current = $root;
        foreach ($keyPath as $key => $val) {
            if (empty($current[$val])) {
                return '';
            }

            $current = $current[$val];
        }
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
