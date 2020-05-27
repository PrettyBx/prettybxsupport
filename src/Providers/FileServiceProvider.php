<?php

declare(strict_types=1);

namespace PrettyBx\Support\Providers;

use PrettyBx\Support\Base\AbstractServiceProvider;
use PrettyBx\Support\Filesystem\Manager;

class FileServiceProvider extends AbstractServiceProvider
{
    protected $singletons = [Manager::class];
}
