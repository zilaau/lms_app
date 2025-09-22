# LMS App (Laravel) — Programming Courses
 
 This is a Learning Management System (LMS) built with Laravel for programming courses. It supports three user roles (Admin, Instructor, Student), course management with video/file uploads, assignments and grading, per-course discussions, progress tracking, and certificates.
 
 ## Features
 - User Roles: Admin, Instructor, Student
 - Course Management: Courses with materials (videos, PDFs, docs), instructor ownership
 - Assignments & Grading: Submissions with grades and feedback
 - Discussions: Threaded discussions and replies per course
 - Progress Tracking: Track completed materials per student
 - Certificates: Auto-issued for completed progress
 
 ## Tech Stack
 - Backend: Laravel PHP Framework
 - Database: MySQL
 - Frontend tooling: Vite (default Laravel setup)
 
 ## Prerequisites
 - PHP 8.2+
 - Composer 2+
 - MySQL 8+ (or compatible)
 - Node.js 18+ (for Vite asset building, optional for API-only usage)
 
 ## Getting Started
 1. Install dependencies
    - Composer: `composer install`
    - Node (optional for assets): `npm install`
 
 2. Copy environment file and generate app key
    - Copy: `cp .env.example .env` (Windows PowerShell: `copy .env.example .env`)
    - Generate key: `php artisan key:generate`
 
 3. Configure database in `.env`
    Update these variables:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=lms_app
    DB_USERNAME=your_user
    DB_PASSWORD=your_password
    ```
 
 4. Run migrations (creates tables)
    ```bash
    php artisan migrate
    ```
 
 5. Seed development sample data (roles, users, courses, materials, enrollments, assignments, submissions, discussions, replies, progress, certificates)
    ```bash
    php artisan db:seed
    ```
 
 6. (Optional) Link storage for public file access
    ```bash
    php artisan storage:link
    ```
 
 7. Serve the application
    ```bash
    php artisan serve
    ```
    The app will run at http://127.0.0.1:8000
 
 ## Development Accounts (Seeded)
 - Admin: `admin@lms.local` / `Admin@12345`
 - Instructors: 
   - `alice@lms.local` / `Password@123`
   - `bob@lms.local` / `Password@123`
 - Students:
   - `charlie@lms.local` / `Password@123`
   - `dana@lms.local` / `Password@123`
   - `evan@lms.local` / `Password@123`
   - `fiona@lms.local` / `Password@123`
 
 ## Database Diagram
 An up-to-date schema for dbdiagram.io is available at `dbdiagram.txt` in the project root.
 
 ## Common Artisan Commands
 - Run server: `php artisan serve`
 - Run migrations: `php artisan migrate`
 - Rollback last migration: `php artisan migrate:rollback`
 - Seed all dev data: `php artisan db:seed`
 - Fresh DB (drop all, migrate, seed): `php artisan migrate:fresh --seed`
 
 ## Notes
 - The project includes only file path placeholders for materials/submissions in seeds. Use `storage:link` to expose storage if you plan to upload/view files locally.
 - You may adjust or extend the seeders in `database/seeders/` to fit your development needs.
 
 ---
 
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
