# Ecommerce

Simple Ecommerce

- Demo: https://ecommerce.anasabdur.com
- Admin: https://ecommerce.anasabdur.com/admin [admin@admin.com, admin]
- Payment Test: https://docs.midtrans.com/docs/testing-payment-on-sandbox

## Requirements

PHP >= 8.1 
https://laravel.com/docs/10.x/releases#support-policy

## Installation in local:

### Use Make File
1. Clone the repository using `git clone git@github.com:anasark/ecommerce.git` command.
2. Go to project folder `cd ecommerce`.
3. Add to host file `127.0.0.1 ecommerce.io` and `127.0.0.1 mysql`
3. Start a Docker development environment using `make start` command.
4. Install dependencies and database structure using `make install` command.
5. don't forget to setup `.env`
6. Run `npm i && npm run build`

### Manually
1. Clone the repository using `git clone git@github.com:anasark/ecommerce.git` command.
2. Go to project folder `cd ecommerce`
3. Add to host file `127.0.0.1 ecommerce.io` and `127.0.0.1 mysql`
4. Start a Docker development environment using `docker compose up -d` command.
5. Copy env file using `cp .env.example .env` command. And setup it.
6. Go into Container shell using `docker compose exec -ti php bash` command.
7. Install dependencies and database structure using command:
```
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```
8. Run `npm i && npm run build`
