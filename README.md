# 🏠 Sistem Pendukung Keputusan Pemilihan Kos Terbaik  
## Menggunakan Metode SAW (Simple Additive Weighting)

Project ini merupakan aplikasi berbasis web yang digunakan untuk membantu pengguna dalam **memilih kos terbaik** berdasarkan beberapa kriteria dengan menggunakan **metode SAW (Simple Additive Weighting)**.

---

## 🎯 Tujuan Aplikasi
Aplikasi ini dibuat untuk:
- Membantu pengguna menentukan kos terbaik berdasarkan kriteria tertentu
- Menerapkan metode **Sistem Pendukung Keputusan (SPK)** dengan algoritma **SAW**
- Sebagai bahan tugas perkuliahan pada mata kuliah SPK

---

## ⚙️ Metode yang Digunakan
Metode yang digunakan adalah:

> ✅ **Simple Additive Weighting (SAW)**  
Metode ini bekerja dengan cara:
1. Menentukan kriteria dan bobot
2. Memberikan nilai pada setiap alternatif
3. Melakukan normalisasi nilai
4. Mengalikan dengan bobot
5. Menentukan peringkat berdasarkan nilai terbesar

---

## 📌 Kriteria Penilaian Kos
Kriteria yang digunakan dalam sistem ini meliputi:

| Kode | Kriteria |
|------|----------|
| C1 | Harga Kos |
| C2 | Jarak ke Kampus |
| C3 | Fasilitas |
| C4 | Keamanan |
| C5 | Kebersihan |
| C6 | Kenyamanan |

---

## 🗂️ Fitur Aplikasi
Beberapa fitur utama dalam aplikasi ini antara lain:

- ✅ Input data alternatif kos
- ✅ Input bobot kriteria
- ✅ Input nilai penilaian kos
- ✅ Proses perhitungan metode SAW
- ✅ Menampilkan hasil perangkingan kos terbaik

---

## 🧱 Struktur Database
Database yang digunakan bernama:


Dengan tabel:
- `saw_aplikasi` → Data kos
- `saw_kriteria` → Bobot kriteria
- `saw_penilaian` → Nilai penilaian kos
- `saw_perankingan` → Hasil akhir perhitungan

---

## 🛠️ Teknologi yang Digunakan
- PHP Native
- MySQL / MariaDB
- HTML, CSS, Bootstrap
- JavaScript
- XAMPP

---

## ▶️ Cara Menjalankan Project

1. Clone repository ini:
```bash
git clone https://github.com/adiraalvianzein/spk-saw-kos.git
