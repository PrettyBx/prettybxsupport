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
        \Bitrix\Main\Loader::class,
    ];
}
