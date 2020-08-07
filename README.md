<div align="center"><img src="https://gitlab.acadelib.com/uploads/-/system/appearance/header_logo/1/logo.svg" alt="Acadelib" width="100"></div>

## Installation

```bash
git clone git@gitlab.acadelib.com:acadelib/backend/app.git backend
cd backend
docker-compose up -d
docker-compose exec app composer install
cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```