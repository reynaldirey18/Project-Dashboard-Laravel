# Project Dashboard Laravel

Aplikasi manajemen project, task, dan man power berbasis Laravel dengan fitur CRUD lengkap dan reporting.

## Fitur Utama

-   ✅ Manajemen Project (CRUD)
-   ✅ Manajemen Man Power (CRUD)
-   ✅ Manajemen Task (CRUD dengan relasi ke Project dan Man Power)
-   📊 Dashboard Ringkas dengan statistik dan chart
-   📄 Reporting detail Project beserta Task dan Man Power terkait
-   📤 Export Report ke Excel (Format XLSX)

## Teknologi

| Komponen       | Teknologi                   |
| -------------- | --------------------------- |
| Framework      | Laravel 10.x                |
| Database       | MySQL 8.0+                  |
| Frontend       | Tailwind CSS, Alpine.js     |
| Data Tables    | Yajra DataTables            |
| Excel Export   | Laravel Excel (maatwebsite) |
| Charts         | Chart.js                    |
| Authentication | Laravel Breeze              |

## Persyaratan Sistem

-   PHP 8.1+
-   Composer 2.0+
-   Node.js 16+
-   MySQL 8.0+
-   NPM 8+

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/project-dashboard.git
cd project-dashboard
```

### 2. Install dependencies

```bash
composer install
npm install
npm run build
```

### 3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi database di .env

### 5. Migrasi database:

```bash
php artisan migrate --seed
```

### 6. Jalankan

```bash
php artisan serve
```

Buka http://localhost:8000 di browser

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
_(Jika Anda menambahkan bagian Lisensi seperti di atas, jangan lupa untuk membuat file `LICENSE` di root proyek Anda yang berisi teks lisensi MIT atau lisensi lain yang Anda pilih)._

@reynaldirp
