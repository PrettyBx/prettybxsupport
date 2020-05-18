<?php

namespace PrettyBx\Support\Traits;

use Illuminate\Validation\Validator;
use Illuminate\Translation\{ArrayLoader, Translator};
use InvalidArgumentException;

trait Validatable
{
    protected $defaultMessages = [
        'required' => 'Не указано поле :attribute',
        'numeric' => 'Поле :attribute должно содержать числовое значение',
    ];

    /**
     * Валидирует переданные данные
     *
     * @access	public
     * @param	array	$data 	
     * @param	array	$rules	Default: null
     * @return	void
     */
    public function validate(array $data, array $rules = null, array $messages = null)
    {
        $rules = $rules ?? (property_exists($this, 'rules') ? $this->rules : []);

        $messages = $messages ?? (property_exists($this, 'messages') ? $this->messages : $this->defaultMessages);

        $locale = property_exists($this, 'locale') ? $this->locale : 'en_US';

        $validator = new Validator(
            new Translator(new ArrayLoader($locale, ''), $locale),
            $data,
            $rules,
            $messages
        );

        if ($validator->fails()) {
            throw new InvalidArgumentException(implode(', ', $validator->errors()->all()));
        }
    }
}
