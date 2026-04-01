<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel 13 Example API
## Installation Steps
1. **Clone the Repository**
   ```bash
   git clone https://github.com/ohansyah/laravel-example-api.git
   cd laravel-example-api
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **IInstall NPM Dependencies**
   ```bash
   npm instal
   ```

4. **Copy the Environment File**  
    Create a copy of the .env.example file and name it .env.
   ```bash
   cp .env.example .env
   ```
   
5. **Generate an Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Configure the Database**
   Update the .env file with your database connection details:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

7. **Run Migrations and Seed the Database**
   ```bash
   php artisan migrate:fresh --seed
   ```

8.  **Start the Laravel Development Server**
    ```bash
    php artisan serve
    ```

---

## Cheat Sheet Laravel 13 API
Generating Controller API
```bash
php artisan make:controller Api/V1/ProductController --api --model=Product
```

Generating Resources (old way)
```bash
php artisan make:resource ProductResource
```

Generating Resources Collection (old way)
```bash
php artisan make:resource ProductCollection
```


Generating JSON:API Resources (new api resource)
```bash
php artisan make:resource ProductJsonApiResource --json-api
```

JSON:API Resources https://laravel.com/docs/13.x/eloquent-resources#jsonapi-resources
Laravel ships with JsonApiResource, a resource class that produces responses compliant with the JSON:API specification (https://jsonapi.org/). It extends the standard JsonResource class and automatically handles resource object structure, relationships, sparse fieldsets, includes, lazy attribute evaluation, and sets the Content-Type header to application/vnd.api+json.

