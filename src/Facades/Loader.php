<?php

namespace PrettyBx\Support\Facades;

use PrettyBx\Support\Base\AbstractFacade;
use Bitrix\Main\Loader as BxLoader;

class Loader extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return BxLoader::class;
    }
}
