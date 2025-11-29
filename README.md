# Coffee Finder - Laravel Web Application

A simple content management system (USCMS) for managing coffee shops, built with Laravel.

## Installation

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations and Seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`

## Default Users

After running the seeder, you can login with:

- **Admin User:**
  - Email: `admin@coffeefinder.com`
  - Password: `password`
  - Role: Admin (can manage all coffee shops)

- **Regular User:**
  - Email: `user@coffeefinder.com`
  - Password: `password`
  - Role: User (can create and manage own coffee shops)

## User Roles

- **Guest** - Can view coffee shops and images
- **User** - Can create coffee shops and upload images (can only edit/delete own content)
- **Admin** - Can manage all coffee shops and images


