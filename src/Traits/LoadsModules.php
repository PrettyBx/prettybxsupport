<?php

declare(strict_types=1);

namespace PrettyBx\Support\Traits;

trait LoadsModules
{
    /**
     * loadModules.
     *
     * @access protected
     * @param array|string|null $modules Default: null
     * @return void
     */
    protected function loadModules($modules = null): void
    {
        if (is_string($modules)) {
            $this->loadModule($modules);

            return;
        }

        if (is_array($modules)) {
            foreach ($modules as $moduleId) {
                $this->loadModule($moduleId);
            }

            return;
        }

        if (property_exists($this, 'modules') && is_array($this->modules)) {
            foreach ($this->modules as $module) {
                $this->loadModule($module);
            }
        }
    }

    /**
     * loadModule.
     *
     * @access	protected
     * @param	string	$moduleId	
     * @return	void
     */
    protected function loadModule(string $moduleId): void
    {
        if (! container()->make('\Bitrix\Main\Loader')->includeModule($moduleId)) {
            throw new \RuntimeException('Module ' . $moduleId . ' could not be loaded');
        }
    }
}
