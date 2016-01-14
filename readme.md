## Health

A web app for tracked shared daily goals.

### Installation / Development

1. Clone repo, run `composer install`.
2. Copy `.env.example` to `.env` and fill out your database credentials.
3. Run `php artisan key:generate` and make sure this key is applied to `.env`.
4. Run `php artisan migrate --seed` to set up the database.

Health makes use of Laravel's Elixir library for front-end development. In order to work on JS components:

1. Ensure you have Gulp installed globally, and run `npm install` in the project directory.
2. Run `gulp watch` while you are developing to automatically compile changes.

### Acknowledgements

Health is based on the following Open Source components:

- Laravel 5.1 for authentication, administration interfaces and data APIs
- React + Redux for the Fill and Leaderboard interfaces (thus far)
- A tiny amount of jQuery to simplify API requests (this will be obliterated at some point soon)