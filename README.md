# Coffee Finder - Laravel Web Application

A simple content management system (USCMS) for managing coffee shops, built with Laravel.

## Features

✅ **CRUD Functionality** - Complete Create, Read, Update, Delete operations for coffee shops
✅ **File Upload** - Upload images with title and description fields
✅ **Authentication** - User registration and login using Laravel Breeze
✅ **Authorization** - Role-based access control (Admin, User, Guest) using Policies and Middleware
✅ **Data Validation** - Comprehensive input validation
✅ **Form Repopulation** - Uses Laravel's `old()` helper for form data retention
✅ **Flash Messages** - User feedback for all operations
✅ **Database Migrations** - All database changes managed through migrations
✅ **MVC Architecture** - Strict Model-View-Controller pattern
✅ **Eloquent ORM** - Database interactions using Eloquent relationships
✅ **Bootstrap UI** - Clean and responsive user interface

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

3. **Database Configuration**
   
   The project uses SQLite by default. To use MySQL, update `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=coffee_finder
   DB_USERNAME=root
   DB_PASSWORD=
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

## Project Structure

- **Models:** `app/Models/`
  - `User.php` - User model with role support
  - `CoffeeShop.php` - Coffee shop model
  - `CoffeeShopImage.php` - Image model with title and description

- **Controllers:** `app/Http/Controllers/`
  - `CoffeeShopController.php` - CRUD operations for coffee shops
  - `CoffeeShopImageController.php` - Image upload and management

- **Policies:** `app/Policies/`
  - `CoffeeShopPolicy.php` - Authorization rules for coffee shops

- **Migrations:** `database/migrations/`
  - User role migration
  - Coffee shops table
  - Coffee shop images table

- **Views:** `resources/views/`
  - `layouts/bootstrap.blade.php` - Main layout with Bootstrap
  - `coffee-shops/` - Coffee shop views
  - `coffee-shop-images/` - Image upload views

## Key Features Implementation

### 1. CRUD Operations
- List all coffee shops (public access)
- View coffee shop details (public access)
- Create coffee shop (authenticated users only)
- Edit coffee shop (owner or admin only)
- Delete coffee shop (owner or admin only)

### 2. File Upload
- Upload images with required title and description
- Image validation (max 5MB, jpeg/png/jpg/gif)
- Images stored in `storage/app/public/coffee-shop-images/`

### 3. Authorization
- **Policies:** `CoffeeShopPolicy` defines who can create, update, delete
- **Service Provider:** Policies registered in `AppServiceProvider`
- **Middleware:** `auth` middleware protects create/edit/delete routes

### 4. Data Validation
- All forms have comprehensive validation rules
- Validation errors displayed with `@error` directive
- Form repopulation using `old()` helper

### 5. Flash Messages
- Success messages for create, update, delete operations
- Displayed using Bootstrap alert components

## Testing the Application

1. **As Guest:**
   - Visit homepage to see coffee shops list
   - View coffee shop details
   - Cannot create or edit (redirected to login)

2. **As User:**
   - Login with `user@coffeefinder.com` / `password`
   - Create new coffee shop
   - Upload images with title and description
   - Edit/delete own coffee shops only

3. **As Admin:**
   - Login with `admin@coffeefinder.com` / `password`
   - Can manage all coffee shops (create, edit, delete any)
   - Can upload images to any coffee shop

## Deployment

### AWS Deployment

详细的 AWS 部署指南请参考：[AWS_DEPLOYMENT_GUIDE.md](./AWS_DEPLOYMENT_GUIDE.md)

**快速部署步骤**:
1. 创建 EC2 实例（Ubuntu 22.04）
2. 安装 PHP 8.4, Composer, MySQL, Nginx
3. 克隆代码到服务器
4. 配置 `.env` 文件（参考 `env.production.template`）
5. 运行 `composer install --no-dev`
6. 运行 `php artisan migrate --force`
7. 运行 `php artisan storage:link`
8. 配置 Nginx 和 HTTPS（Let's Encrypt）
9. 设置文件权限

**部署检查清单**: 请参考 [DEPLOYMENT_CHECKLIST.md](./DEPLOYMENT_CHECKLIST.md)

**演示账户信息**: 请参考 [DEMO_ACCOUNTS.md](./DEMO_ACCOUNTS.md)

## Requirements Met

✅ CRUD Functionality
✅ File Upload (with title and description)
✅ Authentication (Laravel Breeze)
✅ Authorization (Policies + Service Provider + Middleware)
✅ User Roles (Admin, User, Guest)
✅ Database Migrations
✅ MVC Architecture
✅ Eloquent ORM
✅ Data Validation
✅ Form Repopulation (old() helper)
✅ Flash Messages
✅ Clean UI (Bootstrap)
