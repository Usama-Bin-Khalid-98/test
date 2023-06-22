## Requirements:
1. Php
1. Composer
1. Redis

---
## Development Setup:

1. Install dependencies with composer:
    ```
    composer install
    ```
1. Create a database (preferably in mysql)
1. Copy contents of .env.example in a new .env file in root location and update variables according to your settings. 

    *smtp settings are required for sending emails*
1. Generate a key for you app using:
    ```
    php artisan key:generate
    ```
1. Create configuration cache using:
    ```
    php artisan config:cache
    ```
1. Migrate tables to db using:
    ```
    php artisan migrate
    ```
1. To seed db with data use: 
    ```
    php artisan db:seed
    ```
    *please change the emails in NBEAC info table and users table to your own email addresses.*
1. To start development server use:
    ```
    php artisan serve
    ```
