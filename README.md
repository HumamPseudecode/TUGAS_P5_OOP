README - Mini Project Advanced OOP: Sistem E-Commerce LOOMS Hijab
1. Masalah Domain
Pada operasional LOOMS Hijab, produk memiliki perlakuan dan atribut yang berbeda-beda. Misalnya, hijab sering mendapatkan promosi atau diskon, sedangkan harga aksesoris pelengkap cenderung bersifat tetap (tidak ada diskon). Jika sistem keranjang belanja tidak fleksibel, perhitungan total pesanan akan bergantung pada statemen logika bersyarat yang panjang (seperti pengecekan if/else untuk membedakan kategori hijab dan aksesoris). Hal ini tentu akan menyulitkan di kemudian hari apabila toko menambahkan kategori barang baru.

2. Desain Sistem
Desain ini diselesaikan dengan menerapkan Advanced OOP.

Abstraction: Menggunakan abstract class Produk yang memiliki metode abstrak hitungHargaSetelahDiskon(). Ini menjadi standar bahwa semua bentuk produk yang masuk katalog wajib memiliki fungsi menghitung harga akhirnya.
Overriding: Subclass Hijab menimpa fungsi perhitungan harganya agar memotong 10% dari harga asli, sedangkan subclass Aksesoris mengembalikan harga aslinya.
Polymorphism: Saat class Pesanan mencetak nota dari isi keranjang belanja, sistem cukup memanggil $item->hitungHargaSetelahDiskon(). Sistem tidak perlu tahu apakah objek itu Hijab atau Aksesoris, karena masing-masing objek tersebut sudah paham cara menghitung nilainya sendiri.
3. Alasan Pemilihan Relasi
Inheritance ("is-a"): Digunakan karena hubungan Hijab dan Produk merupakan relasi "is-a" (Hijab adalah entitas Produk). Ini sangat efisien untuk dipakai ulang (reuse) agar kita tidak menulis ulang variabel nama dan harga berulang kali.
Composition ("has-a"): Pesanan memiliki relasi "has-a" dengan kumpulan Produk. Sistem keranjang mengkomposisikan (menyusun) banyak objek produk ke dalam satu array tanpa harus melakukan pewarisan kelas (misal, membuat subclass dari pesanan).
Interface ("can-do"): Saya menyematkan interface BisaDilacak pada pesanan. Kemampuan untuk dilacak merupakan kontrak ("can-do") yang jika suatu saat diaplikasikan ke entitas pengiriman lain (seperti jasa ekspedisi/kurir internal), bisa langsung ditambahkan tanpa mengganggu relasi hierarki yang sudah ada.
