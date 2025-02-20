
## Requirements

- PHP (v8.3) + Composer
- Node (v20+)

## Install

- `composer install`
- `npm install & npm run build`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate` (and create sqlite file if not created already)
- `php artisan import:employee-data <path-to-json-file>` to import data
- `composer run dev`
- Open http://localhost:8000/ in a browser and register a new user to access employee list.
- Have fun.
