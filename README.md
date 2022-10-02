# Petshop

E-commerce API

# Prerequisites

* PHP 8.0
* ext-intl for email dns validation

# Run Locally

Clone the repository
```bash
git clone https://github.com/CaddyDz/petshop
```
Switch to the directory
```bash
cd petshop
```
Install dependencies
```bash
composer install
```
Copy environment variables file
```bash
cp .env.example .env
```
Generate Application key
```
php artisan key:generate
```
Migrate and populate the database with dummy data
```bash
php artisan migrate:fresh --seed
```
Generate JWT signing key pair
```bash
php artisan jwt:generate
```
Start the server (or not if Valet)
```bash
php artisan serve
```
