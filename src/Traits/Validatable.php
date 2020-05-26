<?php

namespace PrettyBx\Support\Traits;

use Illuminate\Validation\Validator;
use Illuminate\Translation\{ArrayLoader, Translator};
use PrettyBx\Support\Dictionaries\DefaultValidationMessages as DefaultMessages;
use InvalidArgumentException;

trait Validatable
{
    /**
     * Валидирует переданные данные
     *
     * @access	public
     * @param	array	$data 	
     * @param	array	$rules	Default: null
     * @return	void
     */
    public function validate(array $data, array $rules = null, array $messages = null): void
    {
        $rules = $rules ?? (property_exists($this, 'rules') ? $this->rules : []);

        $validator = new Validator(
            new Translator(new ArrayLoader($this->getValidationLocale(), ''), $this->getValidationLocale()),
            $data,
            $rules,
            $this->getValidationMessages($messages)
        );

        if ($validator->fails()) {
            throw new InvalidArgumentException(implode(', ', $validator->errors()->all()));
        }
    }

    /**
     * Валидирует отдельный атрибут
     *
     * @access	public
     * @param	string	$attribute	
     * @param	mixed 	$value    	
     * @param	array 	$rules    	Default: null
     * @return	void
     */
    public function validateAttribute(string $attribute, $value, array $rules = null): void
    {
        if (empty($rules)) {
            if (property_exists($this, 'rules') && !empty($this->rules[$attribute])) {
                $rules = [$attribute => $this->rules[$attribute]];
            } else {
                $rules = [$attribute => []];
            }
        }

        $validator = new Validator(
            new Translator(new ArrayLoader($this->getValidationLocale(), ''), $this->getValidationLocale()),
            [$attribute => $value],
            $rules,
            $this->getValidationMessages()
        );

        if ($validator->fails()) {
            throw new InvalidArgumentException(implode(', ', $validator->errors()->all()));
        }
    }

    /**
     * getValidationLocale.
     *
     * @access	protected
     * @return	string
     */
    protected function getValidationLocale(): string
    {
        return property_exists($this, 'locale') ? $this->locale : 'en_US';
    }

    /**
     * getValidationMessages.
     *
     * @access	protected
     * @param	array	$messages	
     * @return	array
     */
    protected function getValidationMessages(array $messages = null): array
    {
        return $messages ?? (property_exists($this, 'messages') ? $this->messages : DefaultMessages::getItems());
    }
}
