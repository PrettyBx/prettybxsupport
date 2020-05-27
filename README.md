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
