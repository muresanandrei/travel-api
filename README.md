<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Travel API Description

API is using laravel 11 and sanctum for authentication.
For linting Duster is used.

Duster is a tool that brings together Laravel Pint, PHP_CodeSniffer, PHP-CS-Fixer, and Tighten's Laravel-specific lints in Tlint to provide a powerful and comprehensive linting and fixing toolset for Laravel apps.

## ENV KEYS
Check the .env.example i copied my own keys you can follow that structure

## Instalation

1. Create a database ex: travel_api
2. Run composer install
3. Create .env file or copy from the .env.example
4. Run php artisan key:generate
5. Run php artisan migrate:fresh --seed (To migrate tables with seed data)
6. To run the backend you can use php artisan serve

## Lint
To run duster and check all files: ./vendor/bin/duster lint 
<!--  -->
To fix entire codebase: ./vendor/bin/duster fix

## ROLES
Roles are done using Gate and the user access methods are located in Providers\AuthServiceProvider

## API data and users
Migrations will generate 2 users:

admin@travel.com (admin) password: 12345678

editor@travel.com (editor) password: 12345678

## API Endpoints
This document outlines the structure and functionality of the API routes available in this project.


Protected routes require authentication using Sanctum.

Editor Endpoints

These endpoints are accessible to editors and allow for updating travel information.

    POST /editor/travel/{travelId}/update
        Update the details of a specific travel.
        Middleware: can:update-travel

Admin Endpoints

Admin endpoints are accessible to administrators and facilitate the creation of new travel and tour entries.

    POST /admin/travel/create
        Create a new travel entry.
        Middleware: can:create-travel

    POST /admin/tour/create
        Create a new tour entry.
        Middleware: can:create-tour

Public Routes

Public routes are accessible without authentication.
Tours

The following route retrieves tours data.

    GET /tours
        Retrieve paginated tours data.

Authentication Routes

These routes handle user authentication processes.

    POST /login
        User login endpoint.
        Request Body: { "email": "example@example.com", "password": "password" }

Logout

The following route handles user logout.

    POST /logout
        User logout endpoint.


## POSTMAN 
There is also a postman collection that contains all the endpoints and are ready to use with fields completed and automatically saving auth token without needing manual copy.

To access authenticated routes just use the login endpoint you can change the email when you want to switch to editor or admin both use same password.

To change user access logout endpoint from postman and you can login again as another user.

Postman collection is added in root path of the project and the file is called:

Travel Api.postman_collection