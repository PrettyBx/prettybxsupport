<?php

declare(strict_types=1);

namespace PrettyBx\Support\Facades;

use PrettyBx\Support\Base\AbstractFacade;
use PrettyBx\Support\Filesystem\Manager;

class FileManager extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
