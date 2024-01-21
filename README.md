# MySGB
The place for sharing needs.

## Requirements

- PHP 8.1.9
- Postgresql 15.2
- Docker
- NPM

## Installation
1. Clone this project
    ```bash
    git clone https://github.com/fadhiilrachman/mysgb
    cd mysgb
    ```
2. Install dependencies
    ```bash
    composer install
    ```
    And javascript dependencies
    ```bash
    npm install && npm dev
    ```

3. Set up Laravel configurations
    ```bash
    copy .env.example .env
    php artisan key:generate
    ```

4. Set your database in .env

5. Migrate database
    ```bash
    php artisan migrate --seed
    ```

6. Serve the application
    ```bash
    php artisan serve
    ```

7. Login credentials

**Email:** user@gmail.com

**Password:** password
## Contributing
Feel free to contribute and make a pull request.
