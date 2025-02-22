import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);  // Membuat objek Scanner untuk membaca input dari pengguna

        //Menampilan menu utama porgram
        System.out.println("\n===== MENU PETSHOP =====");
        System.out.println("1. Tampilkan Produk");
        System.out.println("2. Tambah Produk");
        System.out.println("3. Ubah Produk");
        System.out.println("4. Hapus Produk");
        System.out.println("5. Cari Produk");
        System.out.println("0. Keluar");
        
        // Loop utama untuk menangani pilihan pengguna
        while (true) {
            try {
                System.out.print("\nPilih menu: ");
                int pilihan = Integer.parseInt(scanner.nextLine());

                switch (pilihan) {
                    case 1:
                        PetShop.tampilkanProduk();
                        break;
                    case 2:
                        PetShop.tambahProduk();
                        break;
                    case 3:
                        PetShop.ubahProduk();
                        break;
                    case 4:
                        PetShop.hapusProduk();
                        break;
                    case 5:
                        PetShop.mencariProduk();
                        break;
                    case 0:
                        System.out.println("Terima kasih telah menggunakan program ini!");
                        scanner.close();
                        return;
                    default:
                        System.out.println("Pilihan tidak valid!");
                }
            } catch (NumberFormatException e) {
                System.out.println("Masukkan angka yang valid!");
            }
        }
    }
}
