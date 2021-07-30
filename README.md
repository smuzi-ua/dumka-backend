[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/smuzi-ua/dumka-backend/badges/quality-score.png?b=master
)](https://scrutinizer-ci.com/g/smuzi-ua/dumka-backend/badges/quality-score.png?b=master)
[![Build Status](https://scrutinizer-ci.com/g/smuzi-ua/dumka-backend/badges/build.png?b=master)](https://scrutinizer-ci.com/g/smuzi-ua/dumka-backend/build-status/master)

All endpoints are covered with tests, which can be found in `tests` folder.

## Instructions

### Requirements
- PHP 8
- Composer
- PostgreSQL

### Getting started

1. Install dependencies:
```shell
composer install
```

2. Make a new configuration file:
```shell
cp .env.example .env
```
3. Generate encryption key:

```shell
php artisan key:generate
```

4. Edit `.env` file to set your database credentials.

5. Execute database migrations and run "seeding" by using `--seed` option:

```shell
php artisan migrate --seed
```



## Running tests

```
php artisan test
```

## Preview docs locally

```shell
php artisan scribe:generate
php -S 127.0.0.1:4000 -t=docs
```
