# Ecommerce Laravel

Ecommerce web application built with Laravel 12, Jetstream (Livewire), Tailwind CSS, and an admin backoffice to manage catalog, variants, orders, shipments, covers, and drivers.

## Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Functional Architecture](#functional-architecture)
4. [Core Modules](#core-modules)
5. [Requirements](#requirements)
6. [Local Setup](#local-setup)
7. [Environment Configuration](#environment-configuration)
8. [Roles, Permissions, and Seeded Admin User](#roles-permissions-and-seeded-admin-user)
9. [Database](#database)
10. [Purchase Flow](#purchase-flow)
11. [Admin Panel](#admin-panel)
12. [Useful Commands](#useful-commands)
13. [Testing](#testing)
14. [Directory Structure](#directory-structure)
15. [Current Status and Technical Notes](#current-status-and-technical-notes)
16. [Author](#author)
17. [License](#license)

## Project Overview

This project provides a complete online store with:

- Catalog hierarchy by families, categories, and subcategories.
- Products with dynamic variants based on options and features.
- Persistent cart (guest/authenticated) with stock validation.
- User shipping addresses management.
- Checkout flow integrated with Niubiz.
- Automatic PDF ticket generation per order.
- Administrative panel for business and logistics operations.
- Role and permission management with `spatie/laravel-permission`.

## Technology Stack

### Backend

- PHP `^8.2`
- Laravel `^12.0`
- Laravel Jetstream `^5.4` (Livewire stack)
- Laravel Sanctum
- Livewire `^3.6`
- Spatie Laravel Permission `^7.2`
- hardevine/shoppingcart `^3.4`
- barryvdh/laravel-dompdf `^3.1`

### Frontend

- Vite
- Tailwind CSS
- Alpine.js (included in Laravel stack)
- Font Awesome
- Swiper (home slider)
- SweetAlert2

### QA / Development

- Pest + PHPUnit
- Laravel Debugbar
- Laravel Pint

## Functional Architecture

The system is split into two contexts:

- **Public store**:
  catalog browsing, filtering, product details, cart, shipping, and checkout.
- **Backoffice (`/admin`)**:
  master data management and order/shipment operations.

The admin panel is registered in `bootstrap/app.php` as a route group with `admin` prefix, `web` + `auth` middleware, and `admin.*` route names.

## Core Modules

### 1) Catalog

- Hierarchy: `Family -> Category -> SubCategory -> Product`.
- Dynamic filtering by options/features via Livewire (`app/Livewire/Filter.php`).
- Global search by product name from navigation component.

### 2) Product and Variants

- A product can contain multiple options (for example: size, color).
- Variants are automatically generated from selected feature combinations in admin.
- SKU and stock are handled at variant level.

### 3) Cart

- Managed with `hardevine/shoppingcart` (`shopping` instance).
- Restored on login (`RestoreCartItems` listener).
- `VerifyStock` middleware refreshes available stock before cart rendering.

### 4) Shipping and Addresses

- Authenticated users can manage multiple addresses.
- One address can be marked as default.
- Checkout uses the authenticated user's default address.

### 5) Payments (Niubiz)

- Access token and session token generation for checkout.
- Transaction confirmation through `checkout/paid` endpoint.
- If payment is successful (`ACTION_CODE = 000`), order is created and stock is decremented.

### 6) Orders and Logistics

- Order states (`OrderStatus`): `Pending`, `Processing`, `Shipped`, `Completed`, `Cancelled`, `Failed`, `Refunded`.
- Shipment states (`ShipmentStatus`): `Pending`, `Completed`, `Failed`.
- Driver assignment from admin order table.

### 7) PDF Tickets

- On order creation, `OrderObserver` automatically generates a PDF ticket (`storage/app/public/tickets`).

### 8) Home Covers

- Managed through admin CRUD.
- Manual sorting via API `POST /api/sort/covers`.
- Home displays only active covers inside date range (`start_at`, `end_at`).

## Requirements

- PHP 8.2+
- Composer 2+
- Node.js 18+ (recommended LTS)
- NPM 9+
- SQLite (default) or MySQL/PostgreSQL
- Standard Laravel PHP extensions (`mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, etc.)

## Local Setup

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Create environment file and app key:

```bash
cp .env.example .env
php artisan key:generate
```

5. If using SQLite (default project setup):

```bash
touch database/database.sqlite
```

6. Run migrations and seeders:

```bash
php artisan migrate --seed
```

7. Create public storage symlink:

```bash
php artisan storage:link
```

8. Start development environment:

```bash
composer run dev
```

This command runs in parallel:

- Laravel server (`php artisan serve`)
- Queue worker (`php artisan queue:listen`)
- Logs (`php artisan pail`)
- Vite (`npm run dev`)

## Environment Configuration

Important `.env` variables:

### App / DB

- `APP_NAME`
- `APP_ENV`
- `APP_URL`
- `DB_CONNECTION`
- `DB_DATABASE` (for SQLite: `database/database.sqlite`)

### Niubiz

Defined in `config/services.php`:

- `NIUBIZ_MERCHANT_ID`
- `NIUBIZ_USER`
- `NIUBIZ_PASSWORD`
- `NIUBIZ_URL_API`
- `NIUBIZ_URL_JS`

`NIUBIZ_URL_JS` is required to load the checkout script in payment view.

## Roles, Permissions, and Seeded Admin User

Relevant seeders:

- `PermissionSeeder`
- `RoleSeeder`
- `DatabaseSeeder`

### Roles

- `admin`
- `driver`

### Loaded Permissions

- `access dashboard`
- `manage options`
- `manage families`
- `manage categories`
- `manage subcategories`
- `manage products`
- `manage covers`
- `manage drivers`
- `manage orders`
- `manage shipments`

### Seeded Initial Admin User

- Email: `carlosperez@gmail.com`
- Password: `carlosadmin`
- Assigned role: `admin`

## Database

Main domain entities:

- Catalog: `families`, `categories`, `sub_categories`, `products`
- Variants: `variants`, `options`, `features`, `option_product`, `feature_variant`
- Commerce: `shoppingcart`, `addresses`, `orders`
- Logistics: `drivers`, `shipments`
- Security: `users`, `roles`, `permissions`, Spatie pivot tables

Notes:

- `orders.content` and `orders.address` are stored as JSON.
- `orders.total` is migrated to decimal `10,2`.
- `addresses.receiver_info` is stored as JSON.

## Purchase Flow

1. User browses catalog and opens product detail.
2. User selects variant/options and adds to cart.
3. Cart quantities can be edited with stock control.
4. User sets/selects shipping address.
5. Checkout calculates subtotal + fixed shipping (`100`).
6. Niubiz checkout opens.
7. If payment succeeds:
- `Order` is created
- PDF ticket is generated
- Variant stock is decremented
- Processed cart items are removed
8. Order is managed in admin (processing, driver assignment, shipment updates).

## Admin Panel

Base route: `/admin`

Main sections:

- Dashboard
- Options and features
- Families
- Categories
- Subcategories
- Products and variants
- Covers
- Drivers
- Orders
- Shipments

Several views use Livewire tables (`rappasoft/laravel-livewire-tables`) for listing and actions.

## Useful Commands

```bash
# Quick setup defined in composer.json
composer run setup

# Development (server + queue + logs + vite)
composer run dev

# Backend only
php artisan serve

# Frontend only
npm run dev

# Frontend build
npm run build

# Migrate with seed
php artisan migrate --seed

# Run tests
php artisan test
```

## Testing

Pest/PHPUnit suite is available under `tests/Feature` and `tests/Unit`.

Current focus is mainly on:

- authentication/registration
- profile and password
- core Jetstream/Fortify behavior

There are still no dedicated functional tests for:

- cart/checkout flow
- variant generation
- orders/shipments lifecycle
- admin business flows

## Directory Structure

```text
app/
  Enums/
  Http/Controllers/
  Livewire/
  Models/
  Observers/
database/
  factories/
  migrations/
  seeders/
resources/
  views/
routes/
  web.php
  admin.php
  api.php
```

## Current Status and Technical Notes

Review performed against the current repository state (March 2026).

### Key findings

- Previous `README.md` had no project-level documentation.
- Some admin controller methods are still pending (`store/update/show` in specific resources).
- There are minor validation and typo inconsistencies in a few Livewire components.
- Some inherited Jetstream tests do not fully match current project behavior.

### Test run snapshot

Executed command:

```bash
php artisan test
```

Observed result:

- `22` passed
- `7` skipped
- `3` failed

Main failing points:

1. Expected login redirect mismatch (`AuthenticationTest`).
2. Home fails if there are no families (`Navigation` assumes non-empty data).
3. Registration test expectation does not match current auth flow (`RegistrationTest`).

## Author

Maintained by **Joel**.

- Name: `Joel`
- Role: `Full Stack Developer`
- Email: `joelsantiagos001@gmail.com`
- LinkedIn/GitHub: `https://linkedin.com/in/joel-ms`

## License

This project is licensed under the **MIT License**.
