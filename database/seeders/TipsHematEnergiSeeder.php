<?php

namespace Database\Seeders;

use App\Models\TipsHematEnergi;
use Illuminate\Database\Seeder;

class TipsHematEnergiSeeder extends Seeder
{
    /**
     * KF-08: Seeder Data Tips Hemat Energi Awal
     */
    public function run(): void
    {
        $daftarTips = [
            [
                'judul_tips'  => 'Optimasi Penjadwalan AC & Pendingin Ruangan',
                'konten'      => 'Menyesuaikan suhu pendingin ruangan ke 24-25°C dapat menghemat hingga 10-15% pengeluaran listrik bulanan Anda. Gunakan fitur timer otomatis agar sistem mati saat ruangan tidak dihuni atau menjelang subuh.',
                'kategori'    => 'Prioritas Efisiensi',
                'penghematan' => 'Rp180.000 - Rp240.000 / tahun',
                'icon'        => 'ac_unit',
            ],
            [
                'judul_tips'  => 'Tutup Kebocoran Udara dan Perbaiki Insulasi',
                'konten'      => 'Periksa apakah ada celah udara di sekitar jendela dan pintu. Menutup celah kecil menjaga suhu dingin di dalam ruangan lebih tahan lama sehingga beban kompresor AC dapat berkurang drastis.',
                'kategori'    => 'Insulasi',
                'penghematan' => 'Hemat hingga 8%',
                'icon'        => 'door_sliding',
            ],
            [
                'judul_tips'  => 'Turunkan Suhu Dispenser & Pemanas Air',
                'konten'      => 'Pemanas air dispenser mengonsumsi listrik konstan sekitar 350-450 Watt. Matikan sakelar pemanas saat malam hari atau ketika bepergian untuk menghindari pemanasan berulang yang tidak terpakai.',
                'kategori'    => 'Pemanas Air',
                'penghematan' => 'Hemat Rp40.000 / bulan',
                'icon'        => 'water_drop',
            ],
            [
                'judul_tips'  => 'Hilangkan Konsumsi Listrik Vampir (Standby)',
                'konten'      => 'Perangkat elektronik seperti TV, monitor, speaker, dan adaptor charger tetap menyedot daya meski dalam keadaan mati (standby power). Gunakan stop kontak bersakelar untuk memutus aliran sepenuhnya saat tidak digunakan.',
                'kategori'    => 'Standby Power',
                'penghematan' => 'Hemat 5-10% tagihan',
                'icon'        => 'power_settings_new',
            ],
            [
                'judul_tips'  => 'Beralih ke Lampu LED Hemat Energi',
                'konten'      => 'Lampu LED menggunakan daya hingga 75% lebih sedikit dan bertahan hingga 15-25 kali lebih lama dibanding lampu pijar tradisional. Ganti lampu utama dengan LED untuk konsumsi watt yang jauh lebih rendah.',
                'kategori'    => 'Pencahayaan',
                'penghematan' => 'Hemat hingga 75% energi lampu',
                'icon'        => 'lightbulb',
            ],
            [
                'judul_tips'  => 'Gunakan Siklus Pencucian Air Dingin',
                'konten'      => 'Sekitar 80-90% energi yang digunakan mesin cuci terbuang untuk pemanas air. Mencuci pakaian sehari-hari dengan air bersuhu normal mampu membersihkan pakaian secara optimal sekaligus menghemat banyak listrik.',
                'kategori'    => 'Elektronik Rumah',
                'penghematan' => 'Hemat hingga 50% daya mesin cuci',
                'icon'        => 'local_laundry_service',
            ],
            [
                'judul_tips'  => 'Bersihkan Filter AC dan Kumparan Kulkas',
                'konten'      => 'Debu yang menumpuk pada filter AC dan kumparan kondensor kulkas memaksa motor pendingin bekerja lebih berat hingga memakan daya 15% lebih besar. Bersihkan filter secara rutin setiap 2-4 minggu.',
                'kategori'    => 'Perawatan',
                'penghematan' => 'Hemat 10-15% daya pendingin',
                'icon'        => 'cleaning_services',
            ],
            [
                'judul_tips'  => 'Manfaatkan Lampu Luar Ruangan Tenaga Surya',
                'konten'      => 'Ganti lampu taman, teras, atau pagar dengan lampu berbasis panel surya independen. Lampu ini otomatis menyala di malam hari tanpa menambah beban meteran listrik PLN Anda sama sekali.',
                'kategori'    => 'Energi Terbarukan',
                'penghematan' => 'Gratis 100% biaya operasional',
                'icon'        => 'solar_power',
            ],
        ];

        foreach ($daftarTips as $tips) {
            TipsHematEnergi::updateOrCreate(
                ['judul_tips' => $tips['judul_tips']],
                $tips
            );
        }
    }
}
