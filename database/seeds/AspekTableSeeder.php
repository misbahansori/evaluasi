<?php

use App\Models\Bagian;
use Illuminate\Database\Seeder;

class AspekTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bagian = Bagian::all();

        $aspek = [
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Panutan : Mampu memberikan teladan yang baik.', 'kategori' => 'Profesi', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Penentuan prioritas tugas : Menentukan prioritas tugas dengan tepat dan terstruktur.', 'kategori' => 'Profesi', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Pengambilan keputusan : Secara cepat dan tepat', 'kategori' => 'Profesi', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Memahami bawahan : mengetahui & mengukur kemampuan', 'kategori' => 'Profesi', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Motivator: menggerakkan & menggugah semangat bawahan.', 'kategori' => 'Profesi', 'bagian_id' => 1, 'tipe' => 'bulanan'],
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Dokumentasi : Kelengkapan formulis asuhan keperawatan', 'kategori' => 'Profesi', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian Implementasi Askep : meliputi monitoring pasien, terapi, pendelegasian serta mengkomunikasikan temuan - temuan penyimpangan status kesehatan pasien', 'kategori' => 'Profesi', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Ketuntasan penyelesaian masalah pasien : sesuai dengan perencanaan asuhan keperawatan / kebidanan yang telah dibuat', 'kategori' => 'Profesi', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Rasa empati : sikap dalam merespon masalah kesehatan pasien', 'kategori' => 'Profesi', 'bagian_id' => 2, 'tipe' => 'bulanan'],
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian Implementasi dalam melaksanan tugas: meliputi pendelegasian serta mengkomunikasikan temuan - temuan penyimpangan dalam pekerjaan.', 'kategori' => 'Profesi', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Ketuntasan penyelesaian masalah: sesuai dengan ketentuan yang telah dibuat.', 'kategori' => 'Profesi', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Rasa empati : sikap dalam merespon lingkungan sekitar', 'kategori' => 'Profesi', 'bagian_id' => 3, 'tipe' => 'bulanan'],
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Kemandirian Implementasi dalam melaksanan tugas: meliputi pendelegasian serta mengkomunikasikan temuan - temuan penyimpangan dalam pekerjaan.', 'kategori' => 'Profesi', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Ketuntasan penyelesaian masalah: sesuai dengan ketentuan yang telah dibuat.', 'kategori' => 'Profesi', 'bagian_id' => 4, 'tipe' => 'bulanan'],
            ['nama' => 'Rasa empati : sikap dalam merespon lingkungan sekitar', 'kategori' => 'Profesi', 'bagian_id' => 4, 'tipe' => 'bulanan'],

            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1, 'tipe' => 'tahunan'],
		];

		DB::table('aspek')->insert($aspek);
    }
}
