class PetShop:
    # Menginisialisasi atribut objek dengan menggunakan metode setter
    def __init__(self, id="", nama_produk="", kategori_produk="", harga_produk=0):
        self.set_id(id)
        self.set_nama_produk(nama_produk)
        self.set_kategori_produk(kategori_produk)
        self.set_harga_produk(harga_produk)

    # Mengeset nilai atribut ID
    def set_id(self, id):
        self._id = id
    
    # Mengembalikan nilai atribut ID
    def get_id(self):
        return self._id

    # Mengeset nilai atribut nama produk
    def set_nama_produk(self, nama_produk):
        self._nama_produk = nama_produk
    
    # Mengembalikan nilai atribut nama produk
    def get_nama_produk(self):
        return self._nama_produk

    # Mengeset nilai atribut kategori produk
    def set_kategori_produk(self, kategori_produk):
        self._kategori_produk = kategori_produk
    
    # Mengembalikan nilai atribut kategori produk
    def get_kategori_produk(self):
        return self._kategori_produk

    # Mengeset nilai atribut harga produk
    def set_harga_produk(self, harga_produk):
        if harga_produk >= 0:
            self._harga_produk = harga_produk
        else:
            raise ValueError("Harga produk tidak boleh negatif.")
    
    # Mengembalikan nilai atribut harga produk
    def get_harga_produk(self):
        return self._harga_produk

# Fungsi untuk menampilkan daftar produk
def tampilkan_produk(daftar_produk):
    if not daftar_produk:  # Mengecek apakah daftar kosong
        print("\nTidak ada produk dalam daftar.")
        return

    print("\n==============================================")
    print("               Daftar Produk")
    print("==============================================")
    
    # Looping melalui daftar produk dan menampilkan detailnya
    for produk in daftar_produk:
        print(f"ID         : {produk.get_id()}")
        print(f"Nama       : {produk.get_nama_produk()}")
        print(f"Kategori   : {produk.get_kategori_produk()}")
        print(f"Harga      : {produk.get_harga_produk()}")
        print("----------------------------------------------")

# Fungsi untuk menambahkan produk ke dalam daftar
def tambah_produk(daftar_produk):
    # Meminta input dari pengguna
    id = input("\nMasukkan ID: ")
    nama_produk = input("Masukkan Nama Produk: ")
    kategori_produk = input("Masukkan Kategori Produk: ")
    harga_produk = int(input("Masukkan Harga Produk: "))

    # Membuat objek PetShop dan menambahkannya ke dalam daftar
    daftar_produk.append(PetShop(id, nama_produk, kategori_produk, harga_produk))
    print("\nProduk berhasil ditambahkan.")


# Fungsi untuk mengubah informasi produk yang sudah ada
def ubah_produk(daftar_produk):
    id = input("\nMasukkan ID produk yang ingin diubah: ")

    # Mencari produk berdasarkan ID
    for produk in daftar_produk:
        if produk.get_id() == id:
            print("Masukkan data baru:")
            
            # Meminta input baru dan memperbarui atribut produk
            produk.set_nama_produk(input(f"Nama ({produk.get_nama_produk()}): "))
            produk.set_kategori_produk(input(f"Kategori ({produk.get_kategori_produk()}): "))
            produk.set_harga_produk(int(input(f"Harga ({produk.get_harga_produk()}): ")))

            print("\nData produk berhasil diperbarui!")
            return  # Menghentikan fungsi setelah produk ditemukan dan diperbarui
    
    print(f"Produk dengan ID {id} tidak ditemukan.")  # Jika produk tidak ditemukan

# Fungsi untuk menghapus produk dari daftar berdasarkan ID
def hapus_produk(daftar_produk):
    id = input("\nMasukkan ID produk yang ingin dihapus: ")

    # Looping untuk mencari produk berdasarkan ID
    for i, produk in enumerate(daftar_produk):
        if produk.get_id() == id:
            daftar_produk.pop(i)  # Menghapus produk dari daftar
            print("Produk berhasil dihapus.")
            return
    
    print(f"Produk dengan ID {id} tidak ditemukan.")  # Jika produk tidak ditemukan

# Fungsi untuk mencari produk berdasarkan nama
def mencari_produk(daftar_produk):
    nama = input("\nMasukkan Nama produk yang ingin dicari: ")

    # Looping untuk mencari produk berdasarkan nama
    for produk in daftar_produk:
        if nama == produk.get_nama_produk():  # Membandingkan nama produk
            print("\nProduk ditemukan.")
            print("-----------------------------")
            print(f"ID        : {produk.get_id()}")
            print(f"Nama      : {produk.get_nama_produk()}")
            print(f"Kategori  : {produk.get_kategori_produk()}")
            print(f"Harga     : {produk.get_harga_produk()}")
            print("-----------------------------")
            return
    
    print(f'Produk dengan Nama "{nama}" tidak ditemukan.')  # Jika produk tidak ditemukan