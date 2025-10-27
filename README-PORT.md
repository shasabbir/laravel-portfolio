# Laravel Port of Portfolio

This directory contains a fresh Laravel application that ports your Next.js + MongoDB app to Laravel + MySQL, aiming to preserve the same UI and flows.

## What’s included
- Laravel 12 app in `laravel/`
- Tailwind CSS v4 via Vite, mirroring your color tokens and base utilities
- MySQL migrations for Blogs and Publications
- CRUD routes, controllers, and Blade views for Blogs and Publications
- Seeders for sample content
- Initial SQL to create database and user: `database/init.sql`

## Configure MySQL
1. Ensure MySQL is running locally.
2. Create database and user (adjust credentials if desired):

```sql
SOURCE database/init.sql;
```

3. Update `.env` if you changed credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=portfolio_user
DB_PASSWORD=portfolio_pass
```

## Run migrations and seeders
From the `laravel` directory:

```powershell
php artisan migrate --seed
```

If you want to seed specific classes:

```powershell
php artisan db:seed --class=BlogSeeder
php artisan db:seed --class=PublicationSeeder
```

## Build frontend assets
```powershell
npm install
npm run build
```

For local development with hot reloading:
```powershell
npm run dev
# and in another terminal
php artisan serve
```

Visit:
- Home: http://127.0.0.1:8000/
- Blog index: http://127.0.0.1:8000/blog
- Publications: http://127.0.0.1:8000/publications

## Notes on UI parity
- The core layout, typography, colors, and section structure are preserved using Tailwind classes.
- Interactive components (carousel and animated scroll effects) are simplified for now to keep the initial port lean. These can be reintroduced with Alpine.js or a small JS plugin if needed.
- The image paths can reuse your existing `/public/images` directory. Serve via Laravel `public/` or set up a symlink.

## Next steps / Enhancements
- Add contact form endpoint and email delivery (Laravel Mailer)
- Recreate testimonial carousel using, for example, Swiper.js or Embla
- Implement image uploads to `storage/app/public` with `php artisan storage:link`
- Add authentication to protect create/edit/delete routes
- Import historical data from `backup/*.json` into MySQL via an artisan command
