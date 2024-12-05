
# Simple blogging project

A simple project that let the admin manage posts for the public

## The admin can:

1) Manage posts and their types

2) Login without registration using Laravel breeze

## The user can:

1) View just the published posts

2) Like or save a certain post (if logged in)

3) Register and login using Laravel breeze

## How to run this project in your local machine:

After you clone the project you have to run:

* composer install
* copy .env.example .env
* php artisan key:generate
* npm install
* php artisan storage:link
* after creating the database you should run: php artisan migrate --seed
* php artisan serve
* npm run dev

