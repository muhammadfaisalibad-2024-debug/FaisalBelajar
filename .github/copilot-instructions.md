# RSHP Laravel Project

## Project Overview
Veterinary Hospital Management System (RSHP) - Sistem Informasi Manajemen Rumah Sakit Hewan berbasis Laravel framework.

## Features
- Authentication & User Management with role-based access control
- Data Master modules:
  - Users Management
  - Pet Owners (Pemilik)
  - Pets Management
  - Animal Types (Jenis Hewan)
  - Animal Breeds (Ras Hewan)
  - Categories
  - Clinical Categories
  - Therapy Action Codes (Kode Tindakan Terapi)
- Admin Dashboard
- Reports and Analytics

## Technology Stack
- Laravel 12.x Framework
- MySQL Database
- Blade Templates for views
- Bootstrap 5 CSS framework
- Laravel Breeze for authentication

## Development Guidelines
- Follow Laravel best practices and conventions
- Use Eloquent ORM for database operations
- Implement proper validation in controllers
- Use Form Requests for complex validations
- Keep controllers thin, use services for business logic
- Use resource controllers for CRUD operations
- Implement soft deletes where appropriate
- Use database transactions for critical operations

## Database Schema Conventions
- Use plural table names (users, pets, owners)
- Use snake_case for column names
- Include timestamps (created_at, updated_at)
- Use soft deletes (deleted_at) for important tables
- Foreign keys: {table_singular}_id (e.g., owner_id, pet_id)

## Code Style
- Follow PSR-12 coding standards
- Use meaningful variable and method names
- Write descriptive comments for complex logic
- Keep methods focused and concise
- Use type hints for parameters and return types

## Security
- Always validate and sanitize user input
- Use Laravel's built-in CSRF protection
- Implement proper authorization checks
- Hash passwords using bcrypt
- Protect against SQL injection using Eloquent/Query Builder

## Progress Tracking
- [x] Create .github directory structure
- [x] Scaffold Laravel project  
- [x] Configure environment variables
- [x] Update README documentation
- [x] Create database migrations
- [x] Create Eloquent models
- [ ] Implement authentication (Laravel Breeze)
- [x] Create controllers and views
- [x] Create public views (Home, Layanan, Visi Misi, Struktur Org)
- [x] Create CRUD for Owners (Pemilik)
- [x] Create CRUD for Pets (Hewan Peliharaan)
- [ ] Install and compile frontend assets
- [x] Set up database seeder
- [ ] Run migrations and seed database
- [ ] Testing and deployment
