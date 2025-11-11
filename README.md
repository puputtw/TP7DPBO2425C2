# TP7DPBO2425C2


## Janji:
  Saya Putri Ramadhani dengan NIM 2410975 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman  
  Berbasis Objek(DPBO) untuk itu saya tidak akan melakukan kecurangan eperti yang telah dispesiifikasikan, 
  aamiin

## Desain Program:
   Program ini adalah sebuah sistem yang membantu mengelola bacaan(book tracker) seperti data buku, data  
   anggota, dan status bacaan.
   Sistem ini memungkinkan pengguna untuk menambahkan, mengedit, dan menghapus data buku, anggota, serta   
   mencatat progres membaca dari setiap anggota terhadap buku yang dibaca.

## Database:



## Tabel yang ada:

    1. Tabel Books
    
        Tabel ini menyimpan data buku yang tersedia dalam sistem
        -book_id, menyimpan id buku yang mana ID unik untuk setiap buku
        -title, yaitu Judul buku
        -author, yaitu Penulis buku
        -pages, jumlah halaman
        -genre, jenis atau kategori bacaan

   2. Tabel Members
      
      Tabel ini menyimpan data anggota membaca buku
      -member_id, id unik anggota
      -name, nama anggota
      -email, email anggota tidak boleh duplikat atau sama
      
   3. Tabel reading_status
      
       Menyimpan hubungan antara buku dan anggota, termasuk progres membaca,memiliki foreign key ke member_
        id, dan book_id
       -status_id, id unik
       -member_id, id anggota(fk), dari tabel members
       -book_id, id buku(fk), dari tabel books
       -start date, tanggal mulai membaca
       -finish_data, tanggal selesai membaca
       -rating, nilai atau rating buku dari 1/5
       -note, catatan atau review dari pembaca


## Penjelasan Struktur File

   Books.php
      Berisi class Books untuk mengelola data buku.
       -addBook() → Menambah data buku baru ke tabel books
       -getAll() → Mengambil seluruh data buku dari database
       -getById() → Mengambil satu data buku berdasarkan ID
       -updateBook() → Memperbarui data buku tertentu
       -deleteBook() → Menghapus data buku berdasarkan ID

    Members.php
        Berisi class Member untuk mengelola data anggota pembaca. Fungsinya serupa dengan Books, tapi 
        khusus untuk tabel members. Kolom yang dikelola: member_id, name, dan email.
        
    StatusReading.php
        Class yang mengatur data status membaca antar anggota dan buku
        Tabel reading_status berelasi dengan books dan members
         -Menambah catatan bacaan (addStatus())
         -Menampilkan seluruh data bacaan (getAll())
         -Mengambil detail status baca berdasarkan ID (getById())
         -Memperbarui catatan membaca (updateStatus())
         -Menghapus catatan membaca (deleteStatus())

     db.php
         Menggunakan PDO (PHP Data Object) sebagai koneksi database 

      index.php
        File utama atau entry point dari aplikasi.
         -Semua permintaan (request) pengguna pertama kali masuk ke sini.
         -Menangani proses CRUD (Tambah, Update, Delete) dari semua tabel.
         -Mengatur navigasi halaman menggunakan parameter ?page=:
          index.php?page=books → membuka halaman daftar buku
          index.php?page=members → membuka halaman anggota
          index.php?page=reading → membuka halaman status membaca


  ## Alur Program:
     1. Inisialisasi sistem
        dimulai dari index.php yang memuat tiga class yaitu Books.php, 
        Member.php, StatusReading.php
        
     2. Setiap class secara otomatis membuat koneksi ke database melalui 
        config/db.php
        
     3. index.php adalah controller utama yang memeriksa parameter $_POST (untuk 
        Add/Update) dan $_GET (untuk Delete) dan memanggil metode yang sesuai di 
        objek class ($book->addBook(), $member->deleteMember(), dll.). Setelah 
        aksi selesai, halaman di-redirect (menggunakan header("Location:..."))

       Navigasi Halaman:
         Navigasi utama diatur dalam index.php:
         Books → Menampilkan dan mengelola daftar buku
         Members → Menampilkan dan mengelola daftar anggota
         Reading Status → Menampilkan dan mengelola progres membaca setiap anggota
         Navigasi dilakukan menggunakan parameter URL ?page=books, ?page=members, atau ?page=reading

        Operasi CRUD:
             Books
            -Read: Menampilkan semua buku dalam tabel.
            -Create: Form input untuk menambah buku baru (addBook()).
            -Update: Klik tombol Edit, form akan terisi otomatis dengan data lama, lalu update  
             (updateBook()).
            -Delete: Klik Delete, data buku akan dihapus (deleteBook()).

             Members
             -Read: Menampilkan daftar semua anggota.
             -Create: Menambah anggota baru (addMember()).
             -Jika email sudah ada, akan muncul pesan “Email sudah digunakan.”
             -Update: Edit data anggota yang sudah ada (updateMember()).
             -Delete: Hapus data anggota (deleteMember()).

             Reading Status
              -Read: Menampilkan daftar relasi antara anggota dan buku yang mereka baca, lengkap dengan 
               status, tanggal, rating, dan catatan.
              -Create: Menambah catatan baru progres membaca (addStatus()).
              -Update: Edit data yang sudah ada (updateStatus()), form otomatis terisi data sebelumnya.
              -Delete: Hapus status bacaan (deleteStatus()



  ## Dokumentasi:




            

           


       

          
          
        
    
        

      

      

       
      



    

   
