import java.util.ArrayList;
import java.util.Scanner;

class PetShop {
    private String id;
    private String namaProduk;
    private String kategoriProduk;
    private int hargaProduk;

    // Constructor default (tanpa parameter)
    public PetShop() {
        this.id = "";
        this.namaProduk = "";
        this.kategoriProduk = "";
        this.hargaProduk = 0;
    }

    // Constructor dengan parameter
    public PetShop(String id, String namaProduk, String kategoriProduk, int hargaProduk) {
        this.id = id;
        this.namaProduk = namaProduk;
        this.kategoriProduk = kategoriProduk;
        this.hargaProduk = hargaProduk;
    }

    // Mengembalikan nilai atribut ID
    public String getId() { 
        return id; 
    }

    // Mengembalikan nilai atribut nama produk
    public String getNamaProduk() { 
        return namaProduk; 
    }

    // Mengembalikan nilai atribut kategori produk
    public String getKategoriProduk() { 
        return kategoriProduk; 
    }

    // Mengembalikan nilai atribut harga produk
    public int getHargaProduk() { 
        return hargaProduk; 
    }

    // Mengeset nilai atribut nama produk
    public void setNamaProduk(String namaProduk) { 
        this.namaProduk = namaProduk; 
    }

    // Mengeset nilai atribut kategori produk
    public void setKategoriProduk(String kategoriProduk) { 
        this.kategoriProduk = kategoriProduk;
    }

    // Mengeset nilai atribut harga produk
    public void setHargaProduk(int hargaProduk) { 
        this.hargaProduk = hargaProduk; 
    }

    private static Scanner scanner = new Scanner(System.in);
    private static ArrayList<PetShop> daftarProduk = new ArrayList<>();

    // Method untuk menampilkan produk
    public static void tampilkanProduk() {
        if (daftarProduk.isEmpty()) {
            System.out.println("\nTidak ada produk dalam daftar.");
            return;
        }

        System.out.println("\n==============================================");
        System.out.println("               Daftar Produk");
        System.out.println("==============================================");
        for (PetShop produk : daftarProduk) {
            System.out.println("ID         : " + produk.getId());
            System.out.println("Nama       : " + produk.getNamaProduk());
            System.out.println("Kategori   : " + produk.getKategoriProduk());
            System.out.println("Harga      : " + produk.getHargaProduk());
            System.out.println("----------------------------------------------");
        }
    }

    // Method untuk menambah produk
    public static void tambahProduk() {
        System.out.print("\nMasukkan ID: ");
        String id = scanner.nextLine();
        
        System.out.print("Masukkan Nama Produk: ");
        String namaProduk = scanner.nextLine();
        
        System.out.print("Masukkan Kategori Produk: ");
        String kategoriProduk = scanner.nextLine();
        
        System.out.print("Masukkan Harga Produk: ");
        int hargaProduk = Integer.parseInt(scanner.nextLine());

        daftarProduk.add(new PetShop(id, namaProduk, kategoriProduk, hargaProduk));
        System.out.println("\nProduk berhasil ditambahkan.");
    }

    // Method untuk mengubah produk
    public static void ubahProduk() {
        System.out.print("\nMasukkan ID produk yang ingin diubah: ");
        String id = scanner.nextLine();

        for (PetShop produk : daftarProduk) {
            if (produk.getId().equals(id)) {
                System.out.println("Masukkan data baru:");
                
                System.out.print("Nama (" + produk.getNamaProduk() + "): ");
                produk.setNamaProduk(scanner.nextLine());
                
                System.out.print("Kategori (" + produk.getKategoriProduk() + "): ");
                produk.setKategoriProduk(scanner.nextLine());
                
                System.out.print("Harga (" + produk.getHargaProduk() + "): ");
                produk.setHargaProduk(Integer.parseInt(scanner.nextLine()));

                System.out.println("\nData produk berhasil diperbarui!");
                return;
            }
        }
        System.out.println("Produk dengan ID " + id + " tidak ditemukan.");
    }

    // Method untuk menghapus produk
    public static void hapusProduk() {
        System.out.print("\nMasukkan ID produk yang ingin dihapus: ");
        String id = scanner.nextLine();

        for (int i = 0; i < daftarProduk.size(); i++) {
            if (daftarProduk.get(i).getId().equals(id)) {
                daftarProduk.remove(i);
                System.out.println("Produk berhasil dihapus.");
                return;
            }
        }
        System.out.println("Produk dengan ID " + id + " tidak ditemukan.");
    }

    // Method untuk mencari produk
    public static void mencariProduk() {
        System.out.print("\nMasukkan Nama produk yang ingin dicari: ");
        String nama = scanner.nextLine();

        for (PetShop produk : daftarProduk) {
            if (produk.getNamaProduk().contains(nama)) {
                System.out.println("\nProduk ditemukan.");
                System.out.println("-----------------------------");
                System.out.println("ID        : " + produk.getId());
                System.out.println("Nama      : " + produk.getNamaProduk());
                System.out.println("Kategori  : " + produk.getKategoriProduk());
                System.out.println("Harga     : " + produk.getHargaProduk());
                System.out.println("-----------------------------");
                return;
            }
        }
        System.out.println("Produk dengan Nama \"" + nama + "\" tidak ditemukan.");
    }
}
