from PetShop import *

# Inisialisasi list untuk menyimpan produk
daftar_produk = []

# Tampilkan menu hanya sekali di awal
print("\n===== MENU PETSHOP =====")
print("1. Tampilkan Produk")
print("2. Tambah Produk")
print("3. Ubah Produk")
print("4. Hapus Produk")
print("5. Cari Produk")
print("0. Keluar")

# Menu utama program
while True:
    try:
        pilihan = int(input("\nPilih menu: "))
        
        if pilihan == 1:
            tampilkan_produk(daftar_produk)
        elif pilihan == 2:
            tambah_produk(daftar_produk)
        elif pilihan == 3:
            ubah_produk(daftar_produk)
        elif pilihan == 4:
            hapus_produk(daftar_produk)
        elif pilihan == 5:
            mencari_produk(daftar_produk)
        elif pilihan == 0:
            print("Terima kasih telah menggunakan program ini!")
            break
        else:
            print("Pilihan tidak valid!")
    except ValueError:
        print("Masukkan angka yang valid!")
