## Eminent Car Dealership

Modern Laravel-based web application for a car dealership with a public customer-facing site and a secure admin panel. It includes vehicle inventory, brands/categories, blog, testimonials, contact forms, orders/leads, activity logging, image uploads, and more.

### Quick Links
- User site (Docker): `http://localhost:8000`
- Admin site (Docker): `http://localhost:8001`
- User site (Local dev script): `http://localhost:8000`
- Admin site (Local dev script): `http://localhost:8001`
- Vite dev server (Docker dev): `http://localhost:5173`

### Port Summary
- Production Docker service (`app`):
  - User: `8000` → container `80`
  - Admin: `8001` → container `8001`
- Development Docker service (`app-dev`):
  - User: `3000` → container `8000`
  - Admin: `3001` → container `8001`
  - Vite: `5173` → container `5173`
- Local PHP dev (via `start-servers.bat`):
  - User: `8000`
  - Admin: `8001`

### Tech Stack
- Backend: Laravel (PHP)
- Frontend tooling: Vite, Tailwind CSS
- Web server (Docker): Nginx + PHP-FPM
- Database: SQLite by default (can be swapped)
- Caching/Queues (optional in dev): Redis
- Mail testing (dev): MailHog

### Key Features
- Vehicle inventory with brands, categories, images, and details
- Admin dashboard for vehicles, customers, sales, content, reports, and settings
- Public pages: home, search, product details, blog, testimonials, contact
- Image upload, quick view modal, hero carousel, category/brand sliders
- Activity logging and basic RBAC (roles/permissions)

### Repository Structure
- `app/` Laravel application code (controllers, models, services, providers)
- `resources/views/` Blade templates for user and admin UIs
- `public/` Public assets and entrypoint
- `routes/` Split routes: `user.php` and `admin.php` (auto-selected by port)
- `docker/` Nginx and Supervisor configs
- `z_guidelines/` Focused docs for features and maintenance

### Route/Port Behavior
The provider `App\Providers\PortRouteServiceProvider` loads `routes/user.php` for the user port and `routes/admin.php` for the admin port.
- Admin routes are served on port `8001`.
- User routes are served on port `8000` (or the mapped external port in dev).

### Getting Started (Docker: Production-like)
1. Ensure Docker Desktop is running.
2. From project root, run:
   - `docker compose up -d --build`
3. Open:
   - User: `http://localhost:8000`
   - Admin: `http://localhost:8001`

### Getting Started (Docker: Development)
Use the `app-dev` service profile for hot reload and Vite.
1. Run: `docker compose --profile development up -d --build`
2. Open:
   - User: `http://localhost:3000`
   - Admin: `http://localhost:3001`
   - Vite: `http://localhost:5173`

### Getting Started (Local without Docker)
Prereqs: PHP 8+, Composer, Node.js, SQLite
1. Install PHP deps: `composer install`
2. Install JS deps: `npm install`
3. Build assets (optional for prod): `npm run build` or start Vite: `npm run dev`
4. Ensure SQLite exists at `database/database.sqlite` (empty file is fine)
5. Start servers (Windows): run `start-servers.bat`
   - User: `http://localhost:8000`
   - Admin: `http://localhost:8001`

### Environment
- Default DB is SQLite (see `docker-compose.yml` and `.env` if present)
- In Docker, storage paths are volume-mounted for persistence
- Increase upload size and caching via Nginx (`docker/default.conf`)

### Useful Scripts
- `npm run dev` — Start Vite for local development
- `npm run build` — Production asset build
- `start-servers.bat` — Launch two `php artisan serve` instances on 8000/8001

### Admin Access
If seeders create an admin user, check `database/seeders/AdminSeeder.php` for credentials logic. Otherwise, create an admin via the app or tinker.

### Maintenance Docs
See `z_guidelines/` for focused docs:
- Image handling, quick view, logos, favicon, uploads, and troubleshooting
- Database design and blog section specifics

### Troubleshooting
- If ports are busy, stop conflicting services or change the left-hand host port mappings in `docker-compose.yml`.
- If assets don’t load in dev, ensure Vite is running (`npm run dev`) or use the Docker dev profile.
- For 500 errors, check `storage/logs/laravel.log` and Nginx/PHP-FPM logs (Docker containers).


