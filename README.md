# Bridge 14 Games

A full-stack e-commerce web app for purchasing video games, tabletop games, consoles and respective accessories. Built with Laravel, Tailwind CSS and Livewire as a university team project.

## Stack

- **Backend:** Laravel >=12, PHP
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Livewire
- **Database:** SQLite
- **Auth:** Laravel Breeze

## Features

- Product listing with live search and category filtering
- Product pages with descriptions, ratings and reviews
- Session-based cart with quantity management
- Checkout with UK address capture
- Order history with a 30-day per-item returns system
- User profile management
- Contact form

**Admin:**
- Invite-token based admin registration (single-use, 24hr expiry)
- Force password change on first login
- Order management and processing
- Customer management (view, edit, delete)
- Full inventory management system - stock tracking, low stock alerts, product CRUD with image upload, restock logging, and a Chart.js stock report

## Setup

```bash
git clone https://github.com/akh5l/Team-14.git
cd laravel

cp .env.example .env
composer install
npm install

php artisan key:generate
php artisan migrate --seed
php artisan storage:link

npm run dev
php artisan serve
```

## Notes

- PHP 8.2+
- Node 18+
- .env is obviously not committed. Copy `.env.example` and fill in your own values
