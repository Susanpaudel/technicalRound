
# Technical Round Assignment

This repository contains an API-based Laravel project for authentication and order management.

---

## Requirements

- PHP >= 8.2  
- Composer  
- MySQL (or compatible database)  
- Laravel 10.x or above  
- Node.js & npm (optional, if frontend assets are used)

---

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/Susanpaudel/technicalRound.git
cd technicalRound
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Copy `.env` file and configure

```bash
cp .env.example .env
```

Edit `.env` and set your database and other environment variables.

**Sample `.env` file:**

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Run migrations and seed database

```bash
php artisan migrate --seed
```

### 6. (Optional) Install Node dependencies and build assets

```bash
npm install
npm run dev
```

---

## Running the Application

```bash
php artisan serve
```

Visit:  
```
http://localhost:8000
```

---

## API Documentation

The API includes the following endpoints:

### Authentication

- **POST** `/api/register` – Register a new user  
- **POST** `/api/login` – Log in a user and get token  
- **POST** `/api/logout` – Log out (requires authentication)

### Orders

- **POST** `/api/orders` – Create an order  
- **GET** `/api/orders/{id}` – View order details  
- **GET** `/api/orders` – List all orders  
- **DELETE** `/api/orders/{id}` – Delete an order

**Authorization:**  
All order-related endpoints require Bearer Token authentication.

---

## Postman Collection

A Postman collection is included in the repository:  
`/docs/TechnicalRound.postman_collection.json`

Import it into Postman to test the API.

---

## Contact

For any questions or support, contact: **susanpaudel15@gmail.com**

---

*Happy coding!* 🚀
