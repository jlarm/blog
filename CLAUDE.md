# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 blog application built with Filament 4 for the admin panel. The application uses SQLite as the database and Vite for asset compilation. The project follows a content management system structure with Posts, Categories, and Tags entities.

## Architecture

### Core Structure
- **Laravel 12** with PHP 8.2+ requirement
- **Filament 4** admin panel for content management
- **SQLite** database (located at `database/database.sqlite`)
- **Vite** with Tailwind CSS for frontend assets
- **Many-to-many relationships** between Posts-Categories and Posts-Tags

### Key Models & Relationships
- `Post` model with `belongsToMany` relationships to `Category` and `Tag`
- Database uses pivot tables: `category_post` and `post_tag`
- Posts have: `id`, `title`, `slug` (unique), `body`, `image` (nullable), `timestamps`

### Filament Admin Structure
- Resources organized in dedicated folders: `app/Filament/Resources/Posts/`
- Filament resources use separate classes:
  - `PostResource.php` - Main resource definition
  - `Schemas/PostForm.php` - Form schema configuration
  - `Tables/PostsTable.php` - Table configuration
  - `Pages/` - CRUD page classes (List, Create, Edit)

## Development Commands

### Primary Development
```bash
# Start full development environment (server, queue, logs, vite)
composer run dev

# Alternative individual commands:
php artisan serve           # Start Laravel server
php artisan queue:listen    # Start queue worker
php artisan pail           # View logs
npm run dev                # Start Vite dev server
```

### Testing
```bash
composer run test          # Run all tests with config clearing
php artisan test           # Run tests directly
vendor/bin/phpunit         # Run PHPUnit directly
```

### Code Quality
```bash
vendor/bin/pint            # Laravel Pint code formatting
```

### Asset Building
```bash
npm run build              # Build production assets
npm run dev                # Development asset watching
```

### Database Operations
```bash
php artisan migrate                    # Run migrations
php artisan migrate:fresh --seed      # Fresh database with seeders
php artisan db:seed                    # Run seeders only
```

## Key Files & Patterns

### Configuration
- Uses SQLite database (no complex database setup required)
- Tailwind CSS configured via Vite plugin
- Filament automatically upgrades on composer autoload

### Code Patterns
- Filament resources use dedicated schema and table configuration classes
- Models use explicit relationship methods with return types
- Migrations use anonymous classes with `up()` and `down()` methods
- Follows Laravel 12 conventions throughout

### Testing Setup
- PHPUnit configured for in-memory SQLite testing
- Separate Unit and Feature test suites
- Environment variables configured for testing isolation

## Development Notes

- The `composer run dev` script uses `concurrently` to run multiple services
- Filament admin is the primary interface for content management  
- No custom authentication - uses Laravel defaults
- Assets compiled with Vite and Tailwind CSS 4.0
- Queue system configured but may need Redis/database driver for production