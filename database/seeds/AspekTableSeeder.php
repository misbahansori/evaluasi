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
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 1],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 1],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 1],
            ['nama' => 'Panutan : Mampu memberikan teladan yang baik.', 'kategori' => 'Profesi', 'bagian_id' => 1],
            ['nama' => 'Penentuan prioritas tugas : Menentukan prioritas tugas dengan tepat dan terstruktur.', 'kategori' => 'Profesi', 'bagian_id' => 1],
            ['nama' => 'Pengambilan keputusan : Secara cepat dan tepat', 'kategori' => 'Profesi', 'bagian_id' => 1],
            ['nama' => 'Memahami bawahan : mengetahui & mengukur kemampuan', 'kategori' => 'Profesi', 'bagian_id' => 1],
            ['nama' => 'Motivator: menggerakkan & menggugah semangat bawahan.', 'kategori' => 'Profesi', 'bagian_id' => 1],
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 2],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 2],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 2],
            ['nama' => 'Dokumentasi : Kelengkapan formulis asuhan keperawatan', 'kategori' => 'Profesi', 'bagian_id' => 2],
            ['nama' => 'Kemandirian Implementasi Askep : meliputi monitoring pasien, terapi, pendelegasian serta mengkomunikasikan temuan - temuan penyimpangan status kesehatan pasien', 'kategori' => 'Profesi', 'bagian_id' => 2],
            ['nama' => 'Ketuntasan penyelesaian masalah pasien : sesuai dengan perencanaan asuhan keperawatan / kebidanan yang telah dibuat', 'kategori' => 'Profesi', 'bagian_id' => 2],
            ['nama' => 'Rasa empati : sikap dalam merespon masalah kesehatan pasien', 'kategori' => 'Profesi', 'bagian_id' => 2],
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 3],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 3],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 3],
            ['nama' => 'Kemandirian Implementasi dalam melaksanan tugas: meliputi pendelegasian serta mengkomunikasikan temuan - temuan penyimpangan dalam pekerjaan.', 'kategori' => 'Profesi', 'bagian_id' => 3],
            ['nama' => 'Ketuntasan penyelesaian masalah: sesuai dengan ketentuan yang telah dibuat.', 'kategori' => 'Profesi', 'bagian_id' => 3],
            ['nama' => 'Rasa empati : sikap dalam merespon lingkungan sekitar', 'kategori' => 'Profesi', 'bagian_id' => 3],
            ['nama' => 'Hasil kerja : Baik dalam kualitas maupun kuantitas', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4],
            ['nama' => 'Pengetahuan pekerjaan : Mengetahui bidang tugasnya', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4],
            ['nama' => 'Kemandirian : pekerjaan yang bersifat rutin maupun khusus', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4],
            ['nama' => 'Penyelesaian tugas : baik dan tepat waktu', 'kategori' => 'Prestasi kerja', 'bagian_id' => 4],
            ['nama' => 'Ketelitian : Meminimalisir kesalahan dalam bekerja.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Kerja sama : dengan orang lain/kelompok dan berperan aktif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Komunikasi : Mengkomunikasikan aspirasi & inisiatif', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Koordinasi : Berkoordinasi dengan unit kerja terkait', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Ketaatan perintah tugas : Melaksanakan perintah tugas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Tanggung jawab: baik dalam mengakui kesalahan, dan bersedia menanggung resiko atas kesalahan.', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Dedikasi : dalam melaksanakan kepentingan dinas', 'kategori' => 'Sikap Kerja', 'bagian_id' => 4],
            ['nama' => 'Pelaksanaan SPO : persiapan pekerjaan dan sistematika kerja sesuai dengan SPO', 'kategori' => 'Profesi', 'bagian_id' => 4],
            ['nama' => 'Kemandirian Implementasi dalam melaksanan tugas: meliputi pendelegasian serta mengkomunikasikan temuan - temuan penyimpangan dalam pekerjaan.', 'kategori' => 'Profesi', 'bagian_id' => 4],
            ['nama' => 'Ketuntasan penyelesaian masalah: sesuai dengan ketentuan yang telah dibuat.', 'kategori' => 'Profesi', 'bagian_id' => 4],
            ['nama' => 'Rasa empati : sikap dalam merespon lingkungan sekitar', 'kategori' => 'Profesi', 'bagian_id' => 4],
		];

		DB::table('aspek')->insert($aspek);
    }
}
