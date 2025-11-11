# TP7DPBO2425C2

## Janji  
Saya Putri Ramadhani dengan NIM 2410975 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman Berbasis Objek (DPBO). 
Untuk itu saya tidak akan melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.


## Desain Program  
Program ini adalah sebuah sistem yang membantu mengelola bacaan (Book Tracker) seperti data buku, data anggota, dan status bacaan.  
Sistem ini memungkinkan pengguna untuk menambahkan, mengedit, dan menghapus data buku, anggota, serta mencatat progres membaca dari setiap anggota terhadap buku yang dibaca.


## Database

<img width="1557" height="581" alt="Cuplikan layar 2025-11-10 220634" src="https://github.com/user-attachments/assets/18afdbac-a30f-4b0e-8e4f-7c7a6e497013" />



### Tabel yang ada:

#### 1. **Tabel Books**
Tabel ini menyimpan data buku yang tersedia dalam sistem.
- book_id → menyimpan id buku yang mana ID unik untuk setiap buku  
- title → judul buku  
- author → penulis buku  
- pages → jumlah halaman  
- genre → jenis atau kategori bacaan  

#### 2. **Tabel Members**
Tabel ini menyimpan data anggota pembaca buku.
- member_id → id unik anggota  
- name → nama anggota  
- email → email anggota (tidak boleh duplikat atau sama)

#### 3. **Tabel reading_status**
Tabel ini menyimpan hubungan antara buku dan anggota, termasuk progres membaca.  
Memiliki foreign key ke member_id dan book_id.  
- status_id → id unik  
- member_id → id anggota (FK) dari tabel members  
- book_id → id buku (FK) dari tabel books  
- start_date → tanggal mulai membaca  
- finish_date → tanggal selesai membaca  
- rating → nilai atau rating buku dari 1–5  
- note → catatan atau review dari pembaca  


## Penjelasan Struktur File

### Books.php
Berisi class Books untuk mengelola data buku.
- addBook() → Menambah data buku baru ke tabel books  
- getAll() → Mengambil seluruh data buku dari database  
- getById() → Mengambil satu data buku berdasarkan ID  
- updateBook() → Memperbarui data buku tertentu  
- deleteBook() → Menghapus data buku berdasarkan ID  


### Members.php
Berisi class Member untuk mengelola data anggota pembaca.  
Fungsinya serupa dengan Books, tapi khusus untuk tabel members  


### StatusReading.php
Class yang mengatur data status membaca antar anggota dan buku.  
Tabel reading_status berelasi dengan books dan members.  
- addStatus() → Menambah catatan bacaan  
- getAll() → Menampilkan seluruh data bacaan  
- getById() → Mengambil detail status baca berdasarkan ID  
- updateStatus() → Memperbarui catatan membaca  
- deleteStatus() → Menghapus catatan membaca
- 

### db.php
Menggunakan PDO  sebagai koneksi database yang aman dan efisien.

### index.php
File utama atau entry point dari aplikasi.  
- Semua permintaan (request) pengguna pertama kali masuk ke sini.  
- Menangani proses CRUD (Tambah, Update, Delete) dari semua tabel.  
- Mengatur navigasi halaman menggunakan parameter `?page=`:
  - index.php?page=books → membuka halaman daftar buku  
  - index.php?page=members → membuka halaman anggota  
  - index.php?page=reading → membuka halaman status membaca  


## Alur Program

1. Inisialisasi sistem*
   Dimulai dari index.php yang memuat tiga class yaitu Books.php, Member.php, dan StatusReading.php.  

2. Koneksi database otomatis  
   Setiap class akan membuat koneksi ke database melalui config/db.php  

3. Controller utama  
   index.php berperan sebagai pengatur alur logika utama:  
   - Memeriksa $_POST` (untuk Add/Update)  
   - Memeriksa $_GET (untuk Delete)  
   - Memanggil metode yang sesuai seperti $book->addBook() atau $member->deleteMember()  
   - Setelah aksi selesai, halaman akan di-redirect dengan header("Location:...")
       

## Navigasi Halaman
Navigasi utama diatur dalam index.php:
- Books → Menampilkan dan mengelola daftar buku  
- Members → Menampilkan dan mengelola daftar anggota  
- Reading Status → Menampilkan dan mengelola progres membaca setiap anggota  

Navigasi dilakukan menggunakan parameter URL:  
?page=books, ?page=members, atau ?page=reading.


## Operasi CRUD

###  Books
- Read: Menampilkan semua buku dalam tabel.  
- Create: Form input untuk menambah buku baru (addBook()).  
- Update: Klik tombol Edit, form akan terisi otomatis dengan data lama, lalu update (updateBook())
- Delete: Klik Delete, data buku akan dihapus (deleteBook())

###  Members
- Read: Menampilkan daftar semua anggota.  
- Create: Menambah anggota baru (addMember()).  
- Jika email sudah ada, akan muncul pesan Email sudah digunakan.  
- Update: Edit data anggota yang sudah ada (updateMember()).  
- Delete: Hapus data anggota (deleteMember()).  

### Reading Status
- Read: Menampilkan daftar relasi antara anggota dan buku yang mereka baca, lengkap dengan status, tanggal, rating, dan catatan.  
- Create: Menambah catatan baru progres membaca (addStatus()).  
- Update: Edit data yang sudah ada (updateStatus()), form otomatis terisi data sebelumnya.  
- Delete: Hapus status bacaan (deleteStatus()).  



## Dokumentasi
   Tabel Members:
   https://github.com/user-attachments/assets/565d8be5-952a-49ae-965b-a363a82274de

   Tabel Books:
   https://github.com/user-attachments/assets/116b1644-bf23-47d2-8663-62423d53186f

   Tabel ReadingStatus:
   https://github.com/user-attachments/assets/b499ff5b-7feb-416d-bac9-183c3879f91f



            

           


       

          
          
        
    
        

      

      

       
      



    

   
