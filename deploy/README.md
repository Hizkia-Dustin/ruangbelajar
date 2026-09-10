# Deploy Ruang Belajar ke DOM Cloud

Repo: https://github.com/hafidzh958/ruangbelajar (branch `main`).

## Instalasi pertama

1. Commit dan push perubahan lokal beserta `composer.lock`, `package-lock.json`, folder `deploy`, dan perbaikan migration/seeder. Jangan upload `.env`, `vendor`, atau `node_modules`.
2. Buat website baru di DOM Cloud. Pilih sumber GitHub repo di atas, branch `main`. Untuk repo private, pasang deploy key sesuai petunjuk dashboard. Import sumber hanya untuk website baru/kosong: opsi `source` DOM Cloud mengganti isi `public_html`.
3. Aktifkan MySQL pada website, lalu ambil nama database, username, dan password dari dashboard. Melalui SSH/editor server di `public_html`, salin `deploy/env.example` menjadi `.env`. Ganti semua nilai `GANTI_` dengan domain HTTPS dan kredensial database. Jangan memakai `.env` lokal.
4. Buka **Setup → Deploy**, tempel isi `deploy/domcloud.yml`, dan jalankan. Resep memasang PHP 8.3, Node 24, MySQL, routing Nginx, dependensi produksi, dan aset Vite. SSL/domain harus sudah diarahkan ke website ini.
5. Melalui SSH di `public_html`, jalankan `php artisan admin:create`. Password dimasukkan secara tersembunyi. Tidak ada akun default baru pada produksi.
6. Buka `https://DOMAIN/up`, halaman utama, dan `/admin/login`. Data contoh lokal tidak ikut tersalin; isi konten melalui CMS. Jangan jalankan `DatabaseSeeder` atau `AdminSeeder` di produksi karena berisi akun contoh/password tetap.

## Update berikutnya

Push perubahan ke GitHub, lalu jalankan dari SSH dalam `public_html`:

```bash
git pull --ff-only origin main
bash deploy/release.sh
```

Script berhenti jika ada kegagalan, menggunakan migration biasa, menjaga APP_KEY yang sudah ada, dan tidak menghapus database/upload. Backup database dan `storage/app/public` sebelum update. Deployment ini berjalan di tempat (bukan zero-downtime); jika gagal setelah migration, periksa log sebelum mencoba lagi.

`.env` memakai queue `sync` karena aplikasi belum membutuhkan worker terpisah. Email masih dicatat ke log; isi SMTP jika ingin mengirim email sungguhan. Node hanya diperlukan saat build, tidak perlu `npm run dev` atau `php artisan serve` di hosting.

Jika hosting pernah menjalankan migration admin lama atau mengimpor database lokal, ganti password akun default sebelum membuka situs untuk publik. Guard migration hanya berlaku pada instalasi baru.

Integrasi otomatis GitHub Actions belum diaktifkan: memerlukan website DOM Cloud beserta webhook dari akun pemilik. Deployment manual di atas dapat digunakan tanpa secret GitHub.

Referensi: https://domcloud.co/docs/guides/laravel dan https://domcloud.co/docs/deployment/deploy
