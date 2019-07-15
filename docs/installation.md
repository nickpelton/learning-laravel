# Installation

1. Clone repository
2. Copy `.env.example` to `.env` and configure. The `APP_`, `DB_`, and `GOOGLE_` configurations are required.  
3. In the `app` folder run `php artisan migrate` to setup the Database.
4. Run `php artisan passport:install` to generate the required encryption keys for API Oauth

