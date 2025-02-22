<?php
require_once 'PetShop.php'; // Memuat file PetShop.php untuk digunakan dalam halaman ini
$petShop = new PetShop(); // Membuat instance dari kelas PetShop
$view = isset($_GET['view']) ? $_GET['view'] : 'list'; // Menentukan tampilan default ke 'list'
$products = $petShop->getAllProducts(); // Mengambil semua produk dari database (file JSON)
$selectedProduct = null;
$searchResults = null;

// Menangani berbagai aksi berdasarkan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Jika tombol "Tambah Produk" ditekan
    if (isset($_POST['add'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        
        // Menangani upload gambar
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $photoName = basename($_FILES['photo']['name']);
            $photoPath = $uploadDir . $photoName;
            move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
        } 
        // Jika tidak ada gambar yang diunggah, gunakan default
        else {
            $photoPath = "default.jpg";
        }
        
        $petShop->addProduct($id, $name, $category, $price, $photoPath);
        exit();
    } 
    elseif (isset($_POST['get_product'])) {
        $selectedProduct = $petShop->getProductById($_POST['product_id']);
        $view = 'edit';
    }
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $photoName = basename($_FILES['photo']['name']);
            $photoPath = $uploadDir . $photoName;
            move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
        } else {
            $photoPath = $_POST['existing_photo'];
        }
        
        $petShop->updateProduct($id, $name, $category, $price, $photoPath);
        exit();
    }
    elseif (isset($_POST['delete'])) {
        $petShop->deleteProduct($_POST['id']);
        exit();
    }
    elseif (isset($_POST['search'])) {
        $searchResults = $petShop->searchProduct($_POST['search_name']);
        $view = 'search_results';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PetShop Management</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f4f4f4;
        }
        .menu { 
            display: flex; 
            gap: 10px; 
            margin: 20px 0; 
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .menu a { 
            padding: 10px 20px; 
            background-color: #4CAF50; 
            color: white; 
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #45a049;
        }
        .form-group { 
            margin: 15px 0; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 5px; 
            font-weight: bold;
        }
        .form-group input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 300px;
        }
        table { 
            border-collapse: collapse; 
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #4CAF50; 
            color: white; 
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .button { 
            padding: 10px 20px; 
            background-color: #4CAF50; 
            color: white; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>PetShop Management System</h1>
    
    <div class="menu">
        <a href="?view=list">Daftar Produk</a>
        <a href="?view=add">Tambah Produk</a>
        <a href="?view=update">Ubah Produk</a>
        <a href="?view=delete">Hapus Produk</a>
        <a href="?view=search">Cari Produk</a>
    </div>

    <div class="container">
        <?php if ($view == 'list'): ?>
            <h2>Daftar Produk</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Foto</th>
                </tr>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                    <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                    <td><img src="<?php echo htmlspecialchars($product['photo']); ?>" width="120"></td>
                </tr>
                <?php endforeach; ?>
            </table>

        <?php elseif ($view == 'add'): ?>
            <h2>Tambah Produk Baru</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>ID Produk:</label>
                    <input type="text" name="id" required>
                </div>
                <div class="form-group">
                    <label>Nama Produk:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Kategori:</label>
                    <input type="text" name="category" required>
                </div>
                <div class="form-group">
                    <label>Harga:</label>
                    <input type="number" name="price" required>
                </div>
                <div class="form-group">
                    <label>Foto Produk:</label>
                    <input type="file" name="photo" accept="image/*">
                </div>
                <button type="submit" name="add" class="button">Tambah Produk</button>
            </form>

        <?php elseif ($view == 'update'): ?>
            <h2>Ubah Produk</h2>
            <form method="post">
                <div class="form-group">
                    <label>ID Produk yang akan diubah:</label>
                    <input type="text" name="product_id" required>
                </div>
                <button type="submit" name="get_product" class="button">Pilih Produk</button>
            </form>

        <?php elseif ($view == 'edit' && $selectedProduct): ?>
            <h2>Edit Produk</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($selectedProduct['id']); ?>">
                <div class="form-group">
                    <label>Nama Produk:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($selectedProduct['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Kategori:</label>
                    <input type="text" name="category" value="<?php echo htmlspecialchars($selectedProduct['category']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Harga:</label>
                    <input type="number" name="price" value="<?php echo htmlspecialchars($selectedProduct['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Foto Produk:</label>
                    <input type="file" name="photo" accept="image/*">
                    <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($selectedProduct['photo']); ?>">
                </div>
                <button type="submit" name="update" class="button">Update Produk</button>
            </form>

        <?php elseif ($view == 'delete'): ?>
            <h2>Hapus Produk</h2>
            <form method="post">
                <div class="form-group">
                    <label>ID Produk yang akan dihapus:</label>
                    <input type="text" name="id" required>
                </div>
                <button type="submit" name="delete" class="button">Hapus Produk</button>
            </form>

        <?php elseif ($view == 'search'): ?>
            <h2>Cari Produk</h2>
            <form method="post">
                <div class="form-group">
                    <label>Nama Produk:</label>
                    <input type="text" name="search_name" required>
                </div>
                <button type="submit" name="search" class="button">Cari Produk</button>
            </form>

        <?php elseif ($view == 'search_results'): ?>
            <h2>Hasil Pencarian</h2>
            <?php if ($searchResults): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Foto</th>
                    </tr>
                    <?php foreach ($searchResults as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['category']); ?></td>
                        <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product['photo']); ?>" width="100"></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Tidak ada hasil yang ditemukan.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>