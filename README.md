Janji
---
Saya Ririn Marchelina dengan NIM 2303662 mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

Alur Program
---
1. Program dimulai dengan menampilkan menu utama dengan 6 opsi:
- Tampilkan Produk
- Tambah Produk
- Ubah Produk
- Hapus Produk
- Cari Produk
- Keluar
2. Program menggunakan loop while(true) untuk terus berjalan sampai user memilih opsi keluar (0)
Untuk setiap opsi menu:
- Tampilkan Produk (1): Menampilkan semua produk yang tersimpan
- Tambah Produk (2): User memasukkan ID, nama, kategori dan harga produk baru
- Ubah Produk (3): User memasukkan ID produk yang akan diubah, lalu memasukkan data baru
- Hapus Produk (4): User memasukkan ID produk yang akan dihapus
- Cari Produk (5): User memasukkan nama produk yang ingin dicari

Desain Program
---
1.  menggunakan 2 class utama:
- Class Main: Menangani tampilan menu dan input user
- Class PetShop: Mendefinisikan struktur data dan method untuk manipulasi data produk
2. Class PetShop memiliki:
- Atribut: id, namaProduk, kategoriProduk, hargaProduk
- Constructor: default dan dengan parameter
- Getter dan setter untuk setiap atribut
- ArrayList<PetShop> untuk menyimpan daftar produk
3. Method static untuk operasi CRUD:
- tampilkanProduk()
- tambahProduk()
- ubahProduk()
- hapusProduk()
- mencariProduk()
