## Laravel Form Generator
[![Latest Version on Packagist](https://img.shields.io/packagist/v/djmitry/laravel-form-generator.svg)](https://packagist.org/packages/djmitry/laravel-form-generator)
[![Software License](https://img.shields.io/packagist/l/djmitry/laravel-form-generator.svg)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/djmitry/laravel-form-generator.svg)](https://packagist.org/packages/djmitry/laravel-form-generator)

# Установка
```bash
$ composer require djmitry/laravel-form-generator:dev-master
```

# Использование
Эта комманда создаст form.blade.php в папке /resources/views для таблицы users
```bash
php artisan form:generator form --table=users
```

Чтобы указать нужную папку, добавьте её(их) перед именем файла: 
```bash
php artisan form:generator users/form --table=users
```