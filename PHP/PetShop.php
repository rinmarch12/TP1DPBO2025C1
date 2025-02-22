<?php
class PetShop {
    // Menyimpan daftar produk dari file JSON
    private $products;
    private $file_path = 'products.json'; // Lokasi file JSON untuk menyimpan data produk
    
    public function __construct() {
        // Memuat data produk saat objek PetShop dibuat
        $this->loadData();
    }

    // Membaca data dari file JSON dan menyimpannya dalam array $products
    private function loadData() {
        $json_data = file_get_contents($this->file_path); // Membaca isi file JSON
        $this->products = json_decode($json_data, true); // Mengubah JSON menjadi array asosiatif
    }

    // Menyimpan data ke file JSON
    private function saveData($data = null) {
        if ($data === null) {
            $data = $this->products; // Jika tidak ada data yang diberikan, gunakan data saat ini
        }
        file_put_contents($this->file_path, json_encode($data, JSON_PRETTY_PRINT)); // Menyimpan data dalam format JSON
    }

    // Mengembalikan semua produk yang ada
    public function getAllProducts() {
        return $this->products;
    }

    // Mengambil informasi produk berdasarkan ID
    public function getProductById($id) {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return $product; // Mengembalikan produk jika ID cocok
            }
        }
        return null; // Mengembalikan null jika produk tidak ditemukan
    }

    // Menghasilkan ID baru berdasarkan ID terakhir yang ada
    public function getNextId() {
        $max_id = 0;
        foreach ($this->products as $product) {
            $current_id = intval(substr($product['id'], 1)); // Mengambil angka dari ID (mengabaikan huruf awal)
            if ($current_id > $max_id) {
                $max_id = $current_id;
            }
        }
        return 'P' . str_pad($max_id + 1, 3, '0', STR_PAD_LEFT); // Membuat ID baru dengan format P001, P002, dst.
    }

    // Menambahkan produk baru ke dalam daftar
    public function addProduct($id, $name, $category, $price, $photo) {
        $new_product = [
            "id" => $id,
            "name" => $name,
            "category" => $category,
            "price" => (int)$price, // Mengonversi harga ke tipe integer
            "photo" => $photo
        ];
        
        $this->products[] = $new_product; // Menambahkan produk ke dalam array
        $this->saveData(); // Menyimpan perubahan ke dalam file JSON
        return true;
    }

    // Memperbarui data produk berdasarkan ID
    public function updateProduct($id, $name, $category, $price, $photo) {
        foreach ($this->products as &$product) { // Menggunakan referensi untuk mengubah langsung dalam array
            if ($product['id'] == $id) {
                $product['name'] = $name;
                $product['category'] = $category;
                $product['price'] = (int)$price;
                $product['photo'] = $photo;
                $this->saveData(); // Menyimpan perubahan ke dalam file JSON
                return true;
            }
        }
        return false; // Mengembalikan false jika ID tidak ditemukan
    }

    // Menghapus produk berdasarkan ID
    public function deleteProduct($id) {
        foreach ($this->products as $key => $product) {
            if ($product['id'] == $id) {
                unset($this->products[$key]); // Menghapus produk dari array
                $this->products = array_values($this->products); // Mengatur ulang indeks array
                $this->saveData(); // Menyimpan perubahan ke dalam file JSON
                return true;
            }
        }
        return false; // Mengembalikan false jika ID tidak ditemukan
    }

    // Mencari produk berdasarkan nama (pencarian tidak case-sensitive)
    public function searchProduct($name) {
        return array_filter($this->products, function($product) use ($name) {
            return stripos($product['name'], $name) !== false; // Mencari produk yang mengandung kata yang dicari
        });
    }
}
?>
