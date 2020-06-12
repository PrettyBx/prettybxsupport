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

        $root = $this->getBxConfig()->get(array_shift($keyPath));

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

        return $current;
    }

    /**
     * getBxConfig.
     *
     * @access	protected
     * @return	Configuration
     */
    protected function getBxConfig()
    {
        if (empty($this->bxConfig)) {
            $this->bxConfig = Configuration::getInstance();
        }

        return $this->bxConfig;
    }
}
