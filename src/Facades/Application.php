<?php

declare(strict_types=1);

namespace PrettyBx\Support\Facades;

use PrettyBx\Support\Base\AbstractFacade;

/**
 * Class Application
 * @package PrettyBx\Support\Facades
 * @method static addBackgroundJob(callable $job, array $args = [], int $priority)
 * @method static getContext()
 * @method static getCache()
 * @method static getConnection(string $name = "")
 * @method static null|string getDocumentRoot()
 * @method static getInstance()
 * @method static setContext(\Bitrix\Main\Context $context)
 */
class Application extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return '\Bitrix\Main\Application';
    }
}
