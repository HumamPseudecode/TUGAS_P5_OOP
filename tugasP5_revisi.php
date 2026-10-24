<?php

// 3. IMPLEMENTASI INTERFACE
interface BisaDilacak {
    public function getStatusPengiriman(): string;
}

// 3. IMPLEMENTASI ABSTRACT CLASS[cite: 52]
abstract class Produk {
    protected string $nama;
    protected float $harga;

    public function __construct(string $nama, float $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    // Abstract method yang mewajibkan pembuatan fungsi ini di subclass
    abstract public function hitungHargaSetelahDiskon(): float;

    public function getInfo(): string {
        return "Produk: " . $this->nama;
    }
}

// 2. INHERITANCE[cite: 37]
class Hijab extends Produk {
    private string $bahan;

    public function __construct(string $nama, float $harga, string $bahan) {
        parent::__construct($nama, $harga);
        $this->bahan = $bahan;
    }

    // 4. OVERRIDING: Implementasi spesifik untuk Hijab
    public function hitungHargaSetelahDiskon(): float {
        // Aturan bisnis: Hijab mendapat diskon 10%
        return $this->harga - ($this->harga * 0.10);
    }

    // 4. OVERRIDING: Memodifikasi info induk[cite: 39]
    public function getInfo(): string {
        return parent::getInfo() . " (Bahan: {$this->bahan})";
    }
}

class Aksesoris extends Produk {
    
    // 4. OVERRIDING: Implementasi spesifik untuk Aksesoris[cite: 39]
    public function hitungHargaSetelahDiskon(): float {
        // Aturan bisnis: Aksesoris tidak ada diskon (harga normal)
        return $this->harga;
    }

    public function getInfo(): string {
        return parent::getInfo() . " (Aksesoris)";
    }
}

// 2. COMPOSITION & INTERFACE[cite: 42, 43]
class Pesanan implements BisaDilacak {
    private string $namaPelanggan;
    // Composition: Pesanan tersusun dari banyak objek Produk
    private array $keranjang = []; 
    private string $status = "Sedang Dikemas";

    public function __construct(string $namaPelanggan) {
        $this->namaPelanggan = $namaPelanggan;
    }

    public function tambahProduk(Produk $produk): void {
        $this->keranjang[] = $produk;
    }

    public function getStatusPengiriman(): string {
        return "Status Pesanan {$this->namaPelanggan}: {$this->status}";
    }

    public function cetakTotal(): void {
        echo "=== NOTA PESANAN LOOMS HIJAB ===\n";
        
        $total = 0;
        // 4. POLYMORPHISM[cite: 40, 52]
        // Satu pemanggilan `hitungHargaSetelahDiskon()`, namun objek 
        // Hijab dan Aksesoris akan memberikan hasil perhitungan yang berbeda.
        foreach ($this->keranjang as $item) {
            $hargaAkhir = $item->hitungHargaSetelahDiskon();
            $total += $hargaAkhir;
            echo $item->getInfo() . " - Rp" . number_format($hargaAkhir, 0, ',', '.') . "\n";
        }
        
        echo "--------------------------------\n";
        echo "Total Bayar: Rp" . number_format($total, 0, ',', '.') . "\n";
    }
}

// --- 5. JALANKAN PROGRAM ---[cite: 52]
$pesanan = new Pesanan("Siti Khadijah");

$hijab1 = new Hijab("Pashmina Silk", 100000, "Sutra Premium");
$aksesoris1 = new Aksesoris("Bros Dagu Mutiara", 25000);

$pesanan->tambahProduk($hijab1);
$pesanan->tambahProduk($aksesoris1);

echo $pesanan->getStatusPengiriman() . "\n\n";
$pesanan->cetakTotal();

?>