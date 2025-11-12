<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Pegawai;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Gudang;
use App\Models\AkunBank;
use App\Models\Barang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Admin
        Admin::create([
            'username' => 'admin',
            'password' => 'password',
            'nama' => 'Administrator',
            'status' => 'aktif',
            'level' => 'admin'
        ]);

        Admin::create([
            'username' => 'user',
            'password' => 'password',
            'nama' => 'Regular User',
            'status' => 'aktif',
            'level' => 'user'
        ]);

        // Seed Satuan
        $satuan = [
            ['kode_satuan' => 'PCS', 'nama_satuan' => 'Pieces'],
            ['kode_satuan' => 'KG', 'nama_satuan' => 'Kilogram'],
            ['kode_satuan' => 'M', 'nama_satuan' => 'Meter'],
            ['kode_satuan' => 'L', 'nama_satuan' => 'Liter'],
        ];

        foreach ($satuan as $s) {
            Satuan::create($s);
        }

        // Seed Kategori
        $kategori = [
            ['kode_kategori' => 'ELEK', 'nama_kategori' => 'Elektronik'],
            ['kode_kategori' => 'ATK', 'nama_kategori' => 'Alat Tulis Kantor'],
            ['kode_kategori' => 'BANG', 'nama_kategori' => 'Material Bangunan'],
            ['kode_kategori' => 'OTM', 'nama_kategori' => 'Otomotif'],
        ];

        foreach ($kategori as $k) {
            Kategori::create($k);
        }

        // Seed Pegawai
        Pegawai::create([
            'kode_pegawai' => 'PGW001',
            'nama_pegawai' => 'Budi Santoso',
            'bagian' => 'Sales',
            'phone' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123'
        ]);

        Pegawai::create([
            'kode_pegawai' => 'PGW002',
            'nama_pegawai' => 'Siti Rahayu',
            'bagian' => 'Gudang',
            'phone' => '081234567891',
            'alamat' => 'Jl. Sudirman No. 45'
        ]);

        // Seed Customer
        Customer::create([
            'kode_customer' => 'CUST001',
            'nama_customer' => 'Toko Maju Jaya',
            'alamat' => 'Jl. Pahlawan No. 10',
            'phone' => '021123456',
            'nama_pt' => 'PT Maju Jaya Abadi',
            'fax' => '021123457'
        ]);

        // Seed Supplier
        Supplier::create([
            'kode_suplier' => 'SUP001',
            'nama_suplier' => 'Supplier Elektronik',
            'alamat' => 'Jl. Industri No. 5',
            'phone' => '021654321',
            'nama_pt' => 'PT Sumber Elektronik',
            'fax' => '021654322'
        ]);

        // Seed Gudang
        Gudang::create([
            'id_gudang' => 'GDG001',
            'nama_gudang' => 'Gudang Utama'
        ]);

        // Seed Akun Bank
        AkunBank::create([
            'kode_akun' => 'BANK001',
            'nama_akun' => 'BCA - 1234567890'
        ]);

        // Seed Barang
        Barang::create([
            'kode_barang' => 'BRG001',
            'nama_barang' => 'Laptop ASUS',
            'stok' => 10,
            'harga_beli' => 8000000,
            'harga_jual' => 10000000,
            'rak' => 'A1',
            'kode_kategori' => 'ELEK',
            'kode_satuan' => 'PCS'
        ]);

        Barang::create([
            'kode_barang' => 'BRG002',
            'nama_barang' => 'Kertas A4',
            'stok' => 100,
            'harga_beli' => 50000,
            'harga_jual' => 75000,
            'rak' => 'B2',
            'kode_kategori' => 'ATK',
            'kode_satuan' => 'KG'
        ]);

        $this->call(UserSeeder::class);
    }
}