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

## JSON:API Resources
https://laravel.com/docs/13.x/eloquent-resources#jsonapi-resources

Laravel ships with JsonApiResource, a resource class that produces responses compliant with the JSON:API specification (https://jsonapi.org/). It extends the standard JsonResource class and automatically handles resource object structure, relationships, sparse fieldsets, includes, lazy attribute evaluation, and sets the Content-Type header to application/vnd.api+json.

### JSON STRUCTURE
Laravel officially anounced JSON:API, a Specification for building APIs
It will return predictable json response for any frontend client that workd with JSON:API specification
```json
{
  "data": {
    "id": "1", // not integer, but string by specification
    "type": "products", // type of resource
    "attributes": { // fields related to eloquenet
      "name": "qui",
      "barcode": "9183620038675",
      "price": "980.81"
    },
    "relationships": { // relationship related to eloquenet
      "brand": {
        "data": {
          "id": "7",
          "type": "brand"
        }
      },
      "category": {
        "data": {
          "id": "10",
          "type": "category"
        }
      }
    }
  },
  "included": [ // included relationship
    {
      "id": "7",
      "type": "brand",
      "attributes": {
        "name": "Lenovo"
      }
    },
    {
      "id": "10",
      "type": "category",
      "attributes": {
        "name": "Computer Accessories"
      }
    }
  ]
}
```

pretty stricts but it allow client to parse it without any weird unpredictable return and good things for who want live in stnadar JSON:API specification without any extra manual format because laravel now take everythings under the hood

### INCLUDE RELATIONSHIP
JSON:API resources support defining relationships that follow the JSON:API specification. Relationships are only serialized when requested by the client via the include query parameter.

```
{{url}}/api/v1/products-json-api/1?include=brand,category
```
This produces a response with resource identifier objects in the relationships key and full resource objects in the top-level included array:
```json
{
  "data": {
    "id": "1",
    "type": "product_json_apis",
    "attributes": {
      "brand_id": 7,
      "category_id": 10,
      "name": "qui",
      "barcode": "9183620038675",
      "sku": "oel-96684721",
      "price": "980.81",
      "views": 0
    },
    "relationships": { // relations
      "brand": {
        "data": {
          "id": "7",
          "type": "brand_json_apis"
        }
      },
      "category": {
        "data": {
          "id": "10",
          "type": "category_json_apis"
        }
      }
    }
  },
  "included": [ // included
    {
      "id": "7",
      "type": "brand_json_apis",
      "attributes": { // attribute included relation
        "name": "Lenovo"
      }
    },
    {
      "id": "10",
      "type": "category_json_apis",
      "attributes": {
        "name": "Computer Accessories"
      }
    }
  ]
}
```



### SPARSE FIELDSETS - SELECT ATTRIBUTE
JSON:API resources support sparse fieldsets, allowing clients to request only specific attributes for each resource type using the fields[] query parameter:

```
{{url}}/api/v1/products-json-api/1?fields[product_json_apis]=name,barcode,price
```
This will reeturn only attribute name, barcode and price.
```json
{
  "data": {
    "id": "1",
    "type": "product_json_apis",
    "attributes": {
      "name": "qui",
      "barcode": "9183620038675",
      "price": "980.81"
    }
  }
}
```




### FILTER

### SORT
