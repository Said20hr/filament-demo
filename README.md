# Demo Application

A demo application to illustrate how this system works.

[Open in Gitpod](https://gitpod.io/#https://github.com/Said20hr/demo) to edit it and preview your changes with no setup required.

## Installation

Clone the repo locally:

```sh
git clone https://github.com/Said20hr/demo.git demo-app && cd demo-app
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

> **Note**  
> If you get an "Invalid datetime format (1292)" error, this is probably related to the timezone setting of your database.  
> Please see https://dba.stackexchange.com/questions/234270/incorrect-datetime-value-mysql

Create a symlink to the storage:

```sh
php artisan storage:link
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit the URL in your browser, and login with:

-   **Username:** admin@demo.com
-   **Password:** password




