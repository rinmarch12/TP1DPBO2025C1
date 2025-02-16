#include <iostream>
#include <string>
#include <list>

using namespace std;

class PetShop {
private:
    string id;
    string nama_produk;
    string kategori_produk;
    int harga_produk;
    string deskripsi;
    int stok;

public:
// Constructor
    PetShop() {
        this->id = "";
        this->nama_produk = "";
        this->kategori_produk = "";
        this->harga_produk = 0;
        this->deskripsi = "";
        this->stok = 0;
    }

    PetShop(string id, string nama_produk, string kategori_produk, int harga_produk, string deskripsi, int stok) {
        this->id = id;
        this->nama_produk = nama_produk;
        this->kategori_produk = kategori_produk;
        this->harga_produk = harga_produk;
        this->deskripsi = deskripsi;
        this->stok = stok;
    }

    // Getter
    string get_id() { 
        return id; 
    }
    string get_nama_produk() { 
        return nama_produk;
    }
    string get_kategori_produk() { 
        return kategori_produk; 
    }
    int get_harga_produk() { 
        return harga_produk; 
    }
    string get_deskripsi() { 
        return deskripsi; 
    }
    int get_stok() { 
        return stok; 
    }

    // Setter
    void set_nama_produk(string nama) { 
        nama_produk = nama; 
    }
    void set_kategori_produk(string kategori) { 
        kategori_produk = kategori; 
    }
    void set_harga_produk(int harga) { 
        harga_produk = harga; 
    }
    void set_deskripsi(string desc) { 
        deskripsi = desc; 
    }
    void set_stok(int stok_baru) { 
        stok = stok_baru; 
    }

    // Destructor
    ~PetShop(){
    }
};

// Menampilkan semua produk
void tampilkan_produk(list<PetShop> &daftar_produk) {
    if (daftar_produk.empty()) {
        cout << "\nTidak ada produk dalam daftar.\n";
        return;
    }

    cout << "\n==============================================\n";
    cout << "               Daftar Produk\n";
    cout << "==============================================\n";
    for (auto &produk : daftar_produk) {
        cout << "ID         : " << produk.get_id() << endl;
        cout << "Nama       : " << produk.get_nama_produk() << endl;
        cout << "Kategori   : " << produk.get_kategori_produk() << endl;
        cout << "Harga      : " << produk.get_harga_produk() << endl;
        cout << "Stok       : " << produk.get_stok() << endl;
        cout << "Deskripsi  : " << produk.get_deskripsi() << endl;
        cout << "----------------------------------------------\n";
    }
}

// Menambahkan produk ke daftar
void tambah_produk(list<PetShop> &daftar_produk) {
    string id, nama_produk, kategori_produk, deskripsi;
    int harga_produk, stok;
    
    cout << "\nMasukkan ID: ";
    cin >> id;
    cin.ignore();
    
    cout << "Masukkan Nama Produk: ";
    getline(cin, nama_produk);
    
    cout << "Masukkan Kategori Produk: ";
    getline(cin, kategori_produk);
    
    cout << "Masukkan Harga Produk: ";
    cin >> harga_produk;
    cin.ignore();
    
    cout << "Masukkan Deskripsi Produk: ";
    getline(cin, deskripsi);
    
    cout << "Masukkan Stok Produk: ";
    cin >> stok;
    
    daftar_produk.push_back(PetShop(id, nama_produk, kategori_produk, harga_produk, deskripsi, stok));
    cout << "\nProduk berhasil ditambahkan.\n";
}

// Mengubah produk berdasarkan ID
void ubah_produk(list<PetShop> &daftar_produk) {
    string id;
    cout << "\nMasukkan ID produk yang ingin diubah: ";
    cin >> id;
    cin.ignore();

    for (auto &produk : daftar_produk) {
        if (produk.get_id() == id) {
            string nama_produk, kategori_produk, deskripsi;
            int harga_produk, stok;
            
            cout << "Masukkan data baru:\n";
            cout << "Nama (" << produk.get_nama_produk() << "): ";
            getline(cin, nama_produk);
            cout << "Kategori (" << produk.get_kategori_produk() << "): ";
            getline(cin, kategori_produk);
            cout << "Harga (" << produk.get_harga_produk() << "): ";
            cin >> harga_produk;
            cin.ignore();
            cout << "Deskripsi (" << produk.get_deskripsi() << "): ";
            getline(cin, deskripsi);
            cout << "Stok (" << produk.get_stok() << "): ";
            cin >> stok;
            
            produk.set_nama_produk(nama_produk);
            produk.set_kategori_produk(kategori_produk);
            produk.set_harga_produk(harga_produk);
            produk.set_deskripsi(deskripsi);
            produk.set_stok(stok);
            
            cout << "\nData produk berhasil diperbarui!\n";
            return;
        }
    }
    cout << "Produk dengan ID " << id << " tidak ditemukan.\n";
}

// Menghapus produk berdasarkan ID
void hapus_produk(list<PetShop> &daftar_produk) {
    string id;
    cout << "\nMasukkan ID produk yang ingin dihapus: ";
    cin >> id;

    for (auto it = daftar_produk.begin(); it != daftar_produk.end(); ++it) {
        if (it->get_id() == id) {
            daftar_produk.erase(it);
            cout << "Produk berhasil dihapus.\n";
            return;
        }
    }
    cout << "Produk dengan ID " << id << " tidak ditemukan.\n";
}

// Mencari produk berdasarkan nama
void mencari_produk(list<PetShop> &daftar_produk) {
    string nama;
    cout << "\nMasukkan Nama produk yang ingin dicari: ";

    getline(cin, nama);

    for (auto &produk : daftar_produk) {
        if (produk.get_nama_produk().find(nama) >= 0 && produk.get_nama_produk().find(nama) < produk.get_nama_produk().size()) { // Mengecek apakah ditemukan
            cout << "\nProduk ditemukan.\n";
            cout << "-----------------------------\n";
            cout << "ID        : " << produk.get_id() << endl;
            cout << "Nama      : " << produk.get_nama_produk() << endl;
            cout << "Kategori  : " << produk.get_kategori_produk() << endl;
            cout << "Harga     : " << produk.get_harga_produk() << endl;
            cout << "Deskripsi : " << produk.get_deskripsi() << endl;
            cout << "Stok      : " << produk.get_stok() << endl;
            cout << "-----------------------------\n";
            return;
        }
    }
    
    cout << "Produk dengan Nama \"" << nama << "\" tidak ditemukan.\n";
}
