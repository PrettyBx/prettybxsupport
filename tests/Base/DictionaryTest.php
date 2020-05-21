<?php

namespace PrettyBx\Support\Tests\Base;

use PrettyBx\Support\Base\AbstractDictionary;
use PrettyBx\Support\Tests\TestCase;
use InvalidArgumentException;

class DictionaryTest extends TestCase
{
    /**
     * Проверяем, что словарь корректно возвращает значение по запрошенному ключу
     *
     * @return void
     */
    public function testDictionaryReturnsCorrectItem()
    {
        $dictionary = $this->getDictionary();

        $this->assertEquals($dictionary->getItem('K1'), 'Value 1');
        $this->assertEquals($dictionary->getItem('K2'), 'Value 2');
    }

    protected function getDictionary(): AbstractDictionary
    {
        return new class () extends AbstractDictionary {

            public static function getItems(): array
            {
                return [
                    'K1' => 'Value 1',
                    'K2' => 'Value 2',
                ];
            }
        };
    }

    /**
     * Проверяем, что словарь выбрасывает исключение при запросе не существующего значения
     *
     * @return void
     */
    public function testDictionaryThrowsException()
    {
        $dictionary = $this->getDictionary();

        $this->expectException(InvalidArgumentException::class);

        $dictionary->getItem('non-existent');
    }

    /**
     * Проверяем, что словарь отдает корректные ключи
     *
     * @return void
     */
    public function testDictionaryReturnsCodes()
    {
        $dictionary = $this->getDictionary();

        $this->assertEquals($dictionary->getCodes(), ['K1', 'K2']);
    }

    /**
     * Проверяем, что словарь отдает корректные значения
     *
     * @return void
     */
    public function testDictionaryReturnsValues()
    {
        $dictionary = $this->getDictionary();

        $this->assertEquals($dictionary->getValues(), ['Value 1', 'Value 2']);
    }
}