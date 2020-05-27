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
