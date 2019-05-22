# cosy

[![Build Status](https://travis-ci.com/loyep/cosy.svg?token=YhCvPgf5uspm18kxdLkJ&branch=master)](https://travis-ci.com/loyep/cosy)
[![StyleCI](https://github.styleci.io/repos/175727773/shield?branch=master)](https://github.styleci.io/repos/175727773)
[![Latest Stable Version](https://poser.pugx.org/loyep/cosy/v/stable)](https://packagist.org/packages/loyep/cosy)
[![Total Downloads](https://poser.pugx.org/loyep/cosy/downloads)](https://packagist.org/packages/loyep/cosy)
[![Latest Unstable Version](https://poser.pugx.org/loyep/cosy/v/unstable)](https://packagist.org/packages/loyep/cosy)
[![License](https://poser.pugx.org/loyep/cosy/license)](https://packagist.org/packages/loyep/cosy)

> A Laravel-Vue Website.

![](screenshots/home.png)

## Features

- Laravel 5.8 
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Login, register and password reset
- Socialite integration

## Installation

- `composer create-project --prefer-dist loyep/cosy cosy`
- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan cosy:install`)
- `php artisan migrate --seed`
- `npm install`

## Usage

#### Development

```bash
# watch
npm run watch

# dev
npm run dev
```

#### Production

```bash
npm run prod
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## License

cosy is released under an MIT license. See [License](LICENSE) for more information.