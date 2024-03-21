<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Travel Api Description

Api is using laravel 11 and sanctum for authentication.
For linting Duster is used.

Duster is a tool that brings together Laravel Pint, PHP_CodeSniffer, PHP-CS-Fixer, and Tighten's Laravel-specific lints in Tlint to provide a powerful and comprehensive linting and fixing toolset for Laravel apps.

## ENV KEYS
SESSION_DRIVER=cookie
... default laravel 11 env keys

## Instalation

1. Create a database ex: travel_api
2. Run composer install
3. Create .env file or use laravel default one
3. Run php artisan key:generate
4. Run php artisan migrate:fresh --seed (To migrate tables with seed data)
5. To run the backend you can use php artisan serve, valet or helm

## Lint
To run duster and check all files: ./vendor/bin/duster lint
To fix entire codebase: ./vendor/bin/duster fix


## API Endpoints
