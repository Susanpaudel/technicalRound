
# Product Name

Technical Round Assignment.

---

## Requirements

- PHP >= 8.2  
- Composer  
- MySQL (or compatible database)  
- Laravel 9.x or above (if applicable)   

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/Susanpaudel/technicalRound.git
cd your-repo
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Copy `.env` file and configure

```bash
cp .env.example .env
```

Edit `.env` and set your database and other environment variables:

\`\`\`
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
\`\`\`

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Run migrations and seed database

```bash
php artisan migrate --seed
```

### 6. (Optional) Install Node dependencies and build assets

If your project uses frontend tooling like Laravel Mix:

```bash
npm install
npm run dev
```

---

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open your browser and go to:  
```
http://localhost:8000
```

---


## Contact

For any questions or support, contact: your.susanpaudel15@gmail.com

---

*Happy coding!* 🚀
