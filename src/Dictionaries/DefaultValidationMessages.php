<?php

declare(strict_types=1);

namespace PrettyBx\Support\Dictionaries;

use PrettyBx\Support\Base\AbstractDictionary;

class DefaultValidationMessages extends AbstractDictionary
{
    public static function getItems(): array
    {
        return  [
            'required' => 'Не указано поле :attribute',
            'numeric' => 'Поле :attribute должно содержать числовое значение',
        ];
    }
}
