#include "PetShop.cpp"

int main() {
    list<PetShop> daftar_produk; // Membuat list untuk menyimpan objek PetShop
    int pilihan; // Variabel untuk menyimpan pilihan menu pengguna

    cout << "\n===== MENU PETSHOP =====\n";
        cout << "1. Tampilkan Produk\n";
        cout << "2. Tambah Produk\n";
        cout << "3. Ubah Produk\n";
        cout << "4. Hapus Produk\n";
        cout << "5. Cari Produk\n";
        cout << "0. Keluar\n";

    do {
        cout << "\nPilih menu: ";
        cin >> pilihan;
        cin.ignore();

        // Menggunakan switch case untuk menangani pilihan menu
        switch (pilihan) {
            case 1:
                tampilkan_produk(daftar_produk);
                break;
            case 2:
                tambah_produk(daftar_produk);
                break;
            case 3:
                ubah_produk(daftar_produk);
                break;
            case 4:
                hapus_produk(daftar_produk);
                break;
            case 5:
                mencari_produk(daftar_produk);
                break;
            case 0:
                cout << "Terima kasih telah menggunakan program ini!\n";
                break;
            default:
                cout << "Pilihan tidak valid!\n";
        }
    } while (pilihan != 0);
    return 0;
}
