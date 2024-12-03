<?php
namespace Database\Seeders;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat instance Faker
        $faker = Faker::create();

        // Set tanggal mulai dan selesai
        $startDate = Carbon::createFromDate(2024, 11, 1); // startDate = 2024-11-01
        $endDate = Carbon::createFromDate(2024, 11, 10); // endDate = 2024-11-10

        // Loop melalui setiap tanggal dari startDate sampai endDate
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Gunakan faker untuk membuat angka antara 15 hingga 20
            $numberOfTransactions = $faker->numberBetween(15, 20);

            // Loop untuk membuat transaksi berdasarkan jumlah yang dihasilkan
            for ($i = 0; $i < $numberOfTransactions; $i++) {
                Transaksi::create([
                    'tanggal_pembelian' => $date->format('Y-m-d'),
                    'total_harga' => 0,  // Anda bisa mengganti dengan nilai acak jika diperlukan
                    'bayar' => 0,        // Anda bisa mengganti dengan nilai acak jika diperlukan
                    'kembalian' => 0,    // Anda bisa mengganti dengan nilai acak jika diperlukan
                ]);
            }
        }
    }
}
