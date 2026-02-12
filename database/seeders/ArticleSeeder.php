<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Perkembangan Teknologi AI di Indonesia',
                'category' => 'Teknologi',
                'description' => 'Artificial Intelligence (AI) semakin berkembang pesat di Indonesia. Banyak startup teknologi mulai mengadopsi AI untuk berbagai solusi bisnis. Dari chatbot customer service hingga sistem rekomendasi produk, AI telah mengubah cara perusahaan berinteraksi dengan pelanggan. Pemerintah juga mendukung pengembangan AI melalui berbagai program pelatihan dan riset.',
                'image' => null,
            ],
            [
                'title' => 'Tips Memulai Bisnis Online untuk Pemula',
                'category' => 'Bisnis',
                'description' => 'Memulai bisnis online tidak harus rumit. Langkah pertama adalah menentukan produk atau jasa yang ingin dijual. Kemudian, buat akun di marketplace seperti Tokopedia atau Shopee untuk menjangkau lebih banyak pelanggan. Jangan lupa untuk membuat konten menarik di media sosial untuk mempromosikan produk Anda. Konsistensi dan pelayanan yang baik adalah kunci sukses bisnis online.',
                'image' => null,
            ],
            [
                'title' => 'Pentingnya Literasi Digital di Era Modern',
                'category' => 'Pendidikan',
                'description' => 'Literasi digital bukan hanya tentang menggunakan gadget, tetapi juga memahami cara memanfaatkan teknologi dengan bijak. Dalam era informasi yang serba cepat ini, kemampuan untuk memilah informasi yang benar dari yang salah sangat penting. Sekolah dan orang tua perlu bekerja sama untuk mengajarkan literasi digital kepada generasi muda agar mereka dapat menggunakan internet dengan aman dan produktif.',
                'image' => null,
            ],
            [
                'title' => 'Gaya Hidup Sehat di Tengah Kesibukan',
                'category' => 'Lifestyle',
                'description' => 'Menjaga kesehatan di tengah kesibukan kerja memang menantang, namun bukan tidak mungkin. Mulailah dengan kebiasaan kecil seperti berjalan kaki selama 15 menit setiap hari, memilih makanan yang bergizi, dan tidur cukup. Hindari stres berlebihan dengan meluangkan waktu untuk hobi atau aktivitas yang Anda sukai. Kesehatan adalah investasi terbaik untuk masa depan.',
                'image' => null,
            ],
            [
                'title' => 'Manfaat Olahraga Rutin untuk Kesehatan Mental',
                'category' => 'Kesehatan',
                'description' => 'Olahraga tidak hanya baik untuk tubuh, tetapi juga untuk kesehatan mental. Ketika berolahraga, tubuh melepaskan endorfin yang dapat meningkatkan mood dan mengurangi stres. Penelitian menunjukkan bahwa olahraga rutin dapat membantu mengurangi gejala depresi dan kecemasan. Mulailah dengan olahraga ringan seperti jogging atau yoga, lalu tingkatkan intensitasnya secara bertahap.',
                'image' => null,
            ],
            [
                'title' => 'Destinasi Wisata Tersembunyi di Jawa Timur',
                'category' => 'Traveling',
                'description' => 'Jawa Timur menyimpan banyak destinasi wisata yang belum banyak diketahui wisatawan. Dari pantai-pantai tersembunyi di Malang Selatan hingga air terjun eksotis di Lumajang, Jawa Timur menawarkan pengalaman wisata yang tak terlupakan. Jangan lewatkan juga kuliner khas seperti rawon dan sate kambing yang lezat. Rencanakan perjalanan Anda dengan baik untuk menikmati keindahan alam Jawa Timur.',
                'image' => null,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}