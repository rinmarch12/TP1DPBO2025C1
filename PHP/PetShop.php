<?php
class PetShop {
    // Atribut privat untuk produk
    private $id;
    private $namaProduk;
    private $kategoriProduk;
    private $harga;
    private $foto;
    
    // Atribut privat untuk menyimpan semua produk
    private $products = [];
    private $file_path = 'products.json';

    // Konstruktor
    public function __construct($id = '', $namaProduk = '', $kategoriProduk = '', $harga = '', $foto = '') {
        $this->id = $id;
        $this->namaProduk = $namaProduk;
        $this->kategoriProduk = $kategoriProduk;
        $this->harga = $harga;
        $this->foto = $foto;
        $this->loadData();
    }

    // Metode getter
    public function getId() {
        return $this->id;
    }

    public function getNamaProduk() {
        return $this->namaProduk;
    }

    public function getKategoriProduk() {
        return $this->kategoriProduk;
    }

    public function getHarga() {
        return $this->harga;
    }

    public function getFoto() {
        return $this->foto;
    }

    // Metode setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setNamaProduk($namaProduk) {
        $this->namaProduk = $namaProduk;
    }

    public function setKategoriProduk($kategoriProduk) {
        $this->kategoriProduk = $kategoriProduk;
    }

    public function setHarga($harga) {
        $this->harga = $harga;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // Memuat data dari file JSON
    private function loadData() {
        if (file_exists($this->file_path)) {
            $json_data = file_get_contents($this->file_path);
            $this->products = json_decode($json_data, true) ?? [];
        }
    }

    // Menyimpan data ke file JSON
    private function saveData() {
        file_put_contents($this->file_path, json_encode($this->products, JSON_PRETTY_PRINT));
    }

    // Mendapatkan semua produk
    public function getAllProducts() {
        return $this->products;
    }

    // Mendapatkan produk berdasarkan ID
    public function getProductById($id) {
        foreach ($this->products as $product) {
            if ($product['id'] === $id) {
                $this->setId($product['id']);
                $this->setNamaProduk($product['name']);
                $this->setKategoriProduk($product['category']);
                $this->setHarga($product['price']);
                $this->setFoto($product['photo']);
                return $product;
            }
        }
        return null;
    }

    // Menambahkan produk baru
    public function addProduct($id, $name, $category, $price, $photo) {
        $this->setId($id);
        $this->setNamaProduk($name);
        $this->setKategoriProduk($category);
        $this->setHarga($price);
        $this->setFoto($photo);

        $new_product = [
            "id" => $this->getId(),
            "name" => $this->getNamaProduk(),
            "category" => $this->getKategoriProduk(),
            "price" => (int)$this->getHarga(),
            "photo" => $this->getFoto()
        ];
        
        $this->products[] = $new_product;
        $this->saveData();
        return true;
    }

    // Memperbarui produk
    public function updateProduct($id, $name, $category, $price, $photo) {
        foreach ($this->products as &$product) {
            if ($product['id'] === $id) {
                $this->setId($id);
                $this->setNamaProduk($name);
                $this->setKategoriProduk($category);
                $this->setHarga($price);
                $this->setFoto($photo);

                $product['id'] = $this->getId();
                $product['name'] = $this->getNamaProduk();
                $product['category'] = $this->getKategoriProduk();
                $product['price'] = (int)$this->getHarga();
                $product['photo'] = $this->getFoto();
                
                $this->saveData();
                return true;
            }
        }
        return false;
    }

    // Menghapus produk
    public function deleteProduct($id) {
        foreach ($this->products as $key => $product) {
            if ($product['id'] === $id) {
                unset($this->products[$key]);
                $this->products = array_values($this->products);
                $this->saveData();
                return true;
            }
        }
        return false;
    }

    // Mencari produk berdasarkan nama
    public function searchProduct($name) {
        return array_filter($this->products, function($product) use ($name) {
            return stripos($product['name'], $name) !== false;
        });
    }
}
?>
