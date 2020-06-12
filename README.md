# Pretty Bitrix (Support)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/artem-prozorov/prettybxsupport/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/artem-prozorov/prettybxsupport/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/artem-prozorov/prettybxsupport/badges/build.png?b=master)](https://scrutinizer-ci.com/g/artem-prozorov/prettybxsupport/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/artem-prozorov/prettybxsupport/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Библиотека для упрощения работы с  Битрикс

## Установка

```
composer require prettybx/support
```

## Начало работы

1. Инициализируйте сервис провайдер в `local/php_interface/init.php`:
```
(new \PrettyBx\Support\Providers\BitrixMainProvider())->register();
```

## DI container
Для реализации Dependency Injection предлагается использовать Illuminate/Container (DI container из фреймворка Laravel).
Для того, чтобы получить экземпляр контейнера, можно воспользоваться хэлпером `container()`
Пример:
```
$bar = container()->make(\Foo\Bar::class); // получим экземпляр класса \Foo\Bar
```

## Фасады
Для удобства тестирования библиотека подключает к проекту и адаптирует к работе ларавелевские фасады. Чтобы сдлать свой фасад, нужно создать класс, унаследовать его от `PrettyBx\Support\Base\AbstractFacade` и реализовать в нем метод `getFacadeAccessor`, который должен вернуть название класса, спрятанного за фасадом.
Пример:
```
class Foo
{
    public function bar()
    {
        return 'Hi!';
    }
}

class FooFacade extends \PrettyBx\Support\Base\AbstractFacade
{
    protected static function getFacadeAccessor()
    {
        return Foo::class;
    }
}

class Service
{
    public function doAction()
    {
        echo FooFacade::bar(); // Hi!
    }
}
```
В тестах можно использовать так:
```
FooFacade::shouldReceive('bar')->andReturn('Hi!');
```

## Глобальные переменные Bitrix
Так как статические методы и глобальные переменные очень плохо поддаются тестированию, для удобства работы с ними предлагается использовать фасады, результаты работы которых можно легко подменять тестовыми двойниками.

### $GLOBALS['APPLICATION']
Получить экземпляр класса \CMain, размещенные в `$GLOBALS['APPLICATION']`, можно с помощью фасада `PrettyBx\Support\Facades\CMain`
Пример:
```
// Вместо этого
global $APPLICATION;

$contants = $APPLICATION->GetFileContent("/foo/bar.baz");

// Делаем так:
$contants = \PrettyBx\Support\Facades\CMain::GetFileContent("/foo/bar.baz");
```

### $GLOBALS['APPLICATION']
Получить экземпляр класса \CUser можно с помощью фасада `PrettyBx\Support\Facades\CUser`
```
$userId = \PrettyBx\Support\Facades\CUser::getId();
```

### \Bitrix\Main\Application
Данный класс является основополагающим классов в D7, но в нем пристутствуют статические методы. Кроме того, он является синглтоном на уровне кода, то есть получить его экземпляр можно только с помощью метода getInstance. Это очень сильно затрудняет тестирование. Чтобы сделать тестирование этого класса возможным, предлагается использовать его фасад `PrettyBx\Support\Facades\Application`.

## Удобная загрузка модулей Bitrix
В разрабатываемых классах очень часто нужно загружать модули Bitrix. Библиотека предоставляет разработчику удобный инструмент для загрузки модулей. Предлагается использовать трайт `PrettyBx\Support\Traits\LoadsModules`.
Пример:
```
use PrettyBx\Support\Traits\LoadsModules;

class SomeService
{
    use LoadsModules;

    protected $modules = ['iblock', 'catalog'];

    public function __construct()
    {
        $this->loadModules(); // Загрузит те модули, которые указаны в $this->modules
    }

    public function loadOnDemand()
    {
        $this->loadModule('sale'); // Загрузит модуль, который был передан
    }
}
```

В случае, если указанный модуль не может быть загружен, будет выброшено исключение `\RuntimeException`

## Работа с конфигурацией
Библиотека предоставляет удобный инструмент для работы с конфигурацией Bitrix, размещенной в файле `bitrix/.settings.php`. Для того, чтобы получить значение элемента конфигурации, можно воспользоваться вспомогательной функцией `config`.
```
var_dump(config("connections"));
```

Значение многомерного массива можно получить, разделив ключи массива точками, например:
```
var_dump(config("connections.default.host")); // $config['connections]['default']['host']
```

## Валидация данных
Для валидации данных используется библиотека Illuminate/Validation
Для того, чтобы использовать ее, предлагается к нужному классу подключить трайт `PrettyBx\Support\Traits\Validatable`
Пример
```
use PrettyBx\Support\Traits\Validatable;

class Service
{
    use Validatable;

    public function getValidatedRequestData(): array
    {
        $rules = [
            'ID' => 'required|numeric',
            'TYPE' => 'required|string',
        ];

        $this->validate($_POST, $rules);
    }
}
```

В случае, если валидация данных провалится, будет выброшено исключение `\InvalidArgumentException`
Список всех доступных правил валидации можно смотреть здесь https://laravel.com/docs/5.8/validation

## Работа с событиями
Всю работу с событиями предлагается вынести в один класс - EventServiceProvider. Для того, чтобы зарегистрировать свои обработчики событий, создайте класс, наследующийся от `PrettyBx\Support\Providers\AbstractEventServiceProvider`. Укажите события, которые нужно обработать, в массиве в защищенном свойстве `events`. 
Пример:
```
use PrettyBx\Support\Providers\AbstractEventServiceProvider;

class EventServiceProvider extends AbstractEventServiceProvider
{
    protected array $events = [
        [
            'module' => 'iblock', 
            'event' => 'OnAfterIBlockElementAdd',
            'handler' => [\App\EventListeners\IblockEventListener::class, 'afterAdd'],
            'sort' => 100,
        ],
        [
            'module' => 'iblock', 
            'event' => 'OnAfterIBlockElementUpdate',
            'handler' => [\App\EventListeners\IblockEventListener::class, 'afterUpdate'],
            'sort' => 100,
        ],
        [
            'module' => 'iblock', 
            'event' => 'OnBeforeIBlockElementDelete',
            'handler' => 'function_name_here',
            'sort' => 100,
        ],
    ];
}
```

## Работа с файловой системой
Для удобства работы с файлами есть класс `PrettyBx\Support\Filesystem\Manager`, который представляет из себя набор команд для выполнения файловых операций. Рекомендуется зарегистрировать этот класс как синглтон с помощью сервис провайдера:
```
(new \PrettyBx\Support\Providers\FileServiceProvider())->register();
```

Теперь файловые операции, такие как переименование, проверка на существование, получение содержимого, удаление и тд, можно осуществлять следующим образом:
```
use PrettyBx\Support\Filesystem\Manager;

$manager = container()->make(Manager::class);

$file = '/foo/bar';

$contents = $manager->getContents($file);
```
или через фасад:
```
use PrettyBx\Support\Facades\FileManager;

$file = '/foo/bar';
$contents = FileManager::getContants($file);
```

Расширение функционала для работы с файлами
Класс `PrettyBx\Support\Filesystem\Manager` реализует трайт `Illuminate\Support\Traits\Macroable`, что позволяет на лету добавлять в него свои методы. Рекомендуется делать это в сервис провайдерах. Пример добавления метода append:
1. В сервис провайдере добавляем такую команду:
```
Manager::macro('append', function ($filename, $data) {
    $resource = fopen($filename, 'a');

    fwrite($resource, (string) $data);

    fclose($resource);
});
```
2. Пользуемся
```
\PrettyBx\Support\Facades\FileManager::append($this->getFullPath(), $data);
```

## Другие библиотеки в рамках проекта "Pretty Bitrix"
- Удобные фикстуры для юнит тестов: https://github.com/artem-prozorov/prettybxfixtures
