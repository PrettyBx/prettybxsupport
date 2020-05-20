<?php

declare(strict_types=1);

namespace PrettyBx\Support\Traits;

use Bitrix\Main\Loader;

trait LoadsModules
{
    /**
     * loadModules.
     *
     * @access	public
     * @return	void
     */
    protected function loadModules(): void
    {
        if (property_exists($this, 'modules') && is_array($this->modules)) {
            foreach ($this->modules as $module) {
                container()->make(Loader::class)->includeModule($module);
            }
        }
    }
}
