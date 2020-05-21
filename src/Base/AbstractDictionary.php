<?php

declare(strict_types=1);

namespace PrettyBx\Support\Base;

abstract class AbstractDictionary
{
    abstract public static function getItems(): array;

    /**
     * Возвращает элемент списка
     *
     * @access  public static
     * @param   string  $code
     * @return  string
     */
    public static function getItem(string $code): string
    {
        if (!array_key_exists($code, static::getItems())) {
            throw new \InvalidArgumentException('Запрошенный элемент ' . $code . ' отсутствует в словаре ' . __CLASS__);
        }

        return static::getItems()[$code];
    }

    public static function getKeyByValue(string $value)
    {
        return array_search($value, static::getItems());
    }

    /**
     * Возвращает коды существующих элементов словаря
     *
     * @access  public static
     * @return  array
     */
    public static function getCodes(): array
    {
        return array_keys(static::getItems());
    }

    /**
     * Возвращает массив значений словаря
     *
     * @access  public static
     * @return  array
     */
    public static function getValues(): array
    {
        return array_values(static::getItems());
    }
}
