<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'is_published' => true,
                'content' => [
                    'hero' => [
                        'badge' => 'Penerimaan Santri Baru Tahun 2025',
                        'title_1' => 'Pesantren Tahfidz',
                        'title_2' => 'Ahlul Jannah Takalar',
                        'description' => "Mencetak generasi Hafidz yang hafal Al-Qur'an, berakhlak mulia, dan siap mengabdikan kepada masyarakat. Beasiswa penuh untuk yatim dan dhuafa.",
                        'button1_text' => 'Daftar Sekarang',
                        'button1_url' => 'landing.pendaftaran', 
                        'button2_text' => 'Tonton Video',
                        'button2_url' => '#video',
                        'image' => 'https://scontent-sin6-3.xx.fbcdn.net/v/t39.30808-6/485041520_967446265571542_7846373100624332041_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeGsS9aqIUeWaVFP7qu-EGU1jPrdbhDJC_-M-t1uEMkL_39MsNlUqfM2Y6IzJE-jPgjt-YCGCUx1ZIU9Q6POCAMd&_nc_ohc=CN9BRgFTTP0Q7kNvwEQtL96&_nc_oc=AdkuDzp4FpusIDNOmuSI43sZj7rZFICcBTfXpd8kgQ4TYj6c1RzkRNfzuGpwVaigD6Y&_nc_zt=23&_nc_ht=scontent-sin6-3.xx&_nc_gid=xLPMr7oypJDl5Q_ujzlxOg&oh=00_AfmU7Cm_tbgoTwAduTlPZ9_t2R71VtYrFiC5cditB2_1jw&oe=69407B53',
                        'features' => [
                            "Kurikulum Pendidikan Diniyah",
                            "Tahfidz Al-Qur'an"
                        ]
                    ],
                    'about' => [
                        'subtitle' => 'Tentang Kami',
                        'title' => "Membangun Peradaban dengan Teknologi dan Al-Qur'an",
                        'description' => 'Pondok Informatika Al-Madinah adalah lembaga pendidikan non-formal yang memadukan kurikulum kepondokan (Tahfidz & Diniyah) dengan kurikulum IT modern. Kami berkomitmen mencetak santri yang tidak hanya ahli dalam baris kode, tapi juga fasih dalam ayat-ayat suci.',
                        'image_1' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'image_2' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'features' => [
                            [
                                'title' => 'Full Beasiswa',
                                'description' => 'Gratis biaya pendidikan dan asrama bagi yang memenuhi syarat.'
                            ],
                            [
                                'title' => 'Mentor Praktisi',
                                'description' => 'Diajar langsung oleh programmer berpengalaman di industri.'
                            ],
                            [
                                'title' => 'Lingkungan Kondusif',
                                'description' => 'Asrama yang nyaman dan lingkungan yang mendukung ibadah.'
                            ]
                        ]
                    ],
                    'video' => [
                        'title' => 'Lihat Keseharian Kami',
                        'youtube_url' => 'https://www.youtube.com/embed/jfKfPfyJRdk',
                        'stats' => [
                            ['count' => '100+', 'label' => 'Santri Aktif'],
                            ['count' => '50+', 'label' => 'Alumni Terserap'],
                            ['count' => '10+', 'label' => 'Mitra Industri'],
                            ['count' => '30', 'label' => 'Juz Hafalan']
                        ]
                    ],
                    'instagram' => [
                        'subtitle' => 'Social Media',
                        'title' => 'Instagram Pondok Informatika',
                        'description' => 'Ikuti keseharian santri dan update terbaru di Instagram kami.',
                        'link_text' => 'Lihat Lebih Banyak di Instagram',
                        'link_url' => '#'
                    ],
                    'cta' => [
                        'title' => 'Siap Menjadi Programmer Hafidz?',
                        'description' => 'Bergabunglah bersama kami dan jadilah bagian dari generasi teknologi yang berakhlak mulia. Kuota terbatas!',
                        'button1_text' => 'Daftar Sekarang',
                        'button1_url' => 'landing.pendaftaran',
                        'button2_text' => 'Konsultasi via WA',
                        'button2_url' => '#'
                    ]
                ]
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'profil'],
            [
                'title' => 'Profil',
                'is_published' => true,
                'content' => [
                    'hero' => [
                        'title' => 'Profil Pondok Pesantren',
                        'subtitle' => 'Mengenal Lebih Dekat',
                        'description' => 'Pondok Pesantren Tahfidz Ahlul Jannah Takalar adalah lembaga pendidikan Islam yang fokus pada tahfidz Al-Quran dan pembentukan karakter Islami.',
                        'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200'
                    ],
                    'sejarah' => [
                        'title' => 'Sejarah Singkat',
                        'content' => 'Pondok Pesantren Tahfidz Ahlul Jannah Takalar didirikan pada tahun 2015 dengan visi mencetak generasi penghafal Al-Quran yang berakhlak mulia. Berawal dari sebuah musholla kecil dengan 10 santri, kini telah berkembang menjadi lembaga pendidikan Islam yang dipercaya masyarakat.',
                        'year_founded' => '2015',
                        'founder' => 'Ustadz H. Ahmad Syahid, Lc.'
                    ],
                    'visi_misi' => [
                        'visi' => 'Menjadi lembaga pendidikan Islam terdepan dalam mencetak generasi penghafal Al-Quran yang berakhlakul karimah dan bermanfaat bagi umat.',
                        'misi' => [
                            'Menyelenggarakan pendidikan tahfidz Al-Quran dengan metode yang efektif dan menyenangkan',
                            'Membentuk karakter santri yang berakhlak mulia berdasarkan nilai-nilai Islam',
                            'Mengembangkan potensi santri di bidang akademik dan non-akademik',
                            'Membangun kerjasama dengan berbagai pihak untuk kemajuan pendidikan'
                        ]
                    ],
                    'fasilitas' => [
                        'title' => 'Fasilitas Pondok',
                        'items' => [
                            [
                                'name' => 'Asrama Nyaman',
                                'description' => 'Asrama dengan kapasitas 200 santri dilengkapi AC dan kamar mandi dalam',
                                'icon' => 'fa-home'
                            ],
                            [
                                'name' => 'Masjid Luas',
                                'description' => 'Masjid 2 lantai dengan kapasitas 500 jamaah',
                                'icon' => 'fa-mosque'
                            ],
                            [
                                'name' => 'Perpustakaan',
                                'description' => 'Koleksi 5000+ buku Islam dan umum',
                                'icon' => 'fa-book'
                            ],
                            [
                                'name' => 'Ruang Kelas',
                                'description' => '15 ruang kelas ber-AC dengan fasilitas multimedia',
                                'icon' => 'fa-chalkboard-teacher'
                            ],
                            [
                                'name' => 'Lapangan Olahraga',
                                'description' => 'Lapangan futsal, basket, dan voli',
                                'icon' => 'fa-futbol'
                            ],
                            [
                                'name' => 'Kantin Sehat',
                                'description' => 'Menyediakan makanan bergizi dan halal',
                                'icon' => 'fa-utensils'
                            ]
                        ]
                    ],
                    'prestasi' => [
                        'title' => 'Prestasi yang Diraih',
                        'items' => [
                            'Juara 1 MTQ Tingkat Kabupaten Takalar 2023',
                            'Juara 2 Tahfidz Competition Sulawesi Selatan 2023',
                            'Juara 3 Musabaqah Hifdzil Quran Nasional 2022',
                            'Santri Terbaik Wisuda Tahfidz 30 Juz - 25 Santri'
                        ]
                    ],
                    'statistik' => [
                        ['count' => '500+', 'label' => 'Total Santri'],
                        ['count' => '300+', 'label' => 'Alumni'],
                        ['count' => '50+', 'label' => 'Ustadz & Ustadzah'],
                        ['count' => '30', 'label' => 'Juz Target Hafalan']
                    ]
                ]
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'kontak'],
            [
                'title' => 'Kontak',
                'is_published' => true,
                'content' => [
                    'hero' => [
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Kontak & Informasi',
                        'description' => 'Kami siap membantu Anda. Jangan ragu untuk menghubungi kami melalui berbagai channel yang tersedia.'
                    ],
                    'contact_info' => [
                        'alamat' => [
                            'label' => 'Alamat',
                            'value' => 'Jl. Pendidikan No. 123, Takalar, Sulawesi Selatan 92212',
                            'icon' => 'fa-map-marker-alt'
                        ],
                        'telepon' => [
                            'label' => 'Telepon',
                            'value' => '+62 812-3456-7890',
                            'icon' => 'fa-phone'
                        ],
                        'email' => [
                            'label' => 'Email',
                            'value' => 'info@ponpestakalar.ac.id',
                            'icon' => 'fa-envelope'
                        ],
                        'whatsapp' => [
                            'label' => 'WhatsApp',
                            'value' => '+62 812-3456-7890',
                            'link' => 'https://wa.me/6281234567890',
                            'icon' => 'fa-whatsapp'
                        ]
                    ],
                    'jam_operasional' => [
                        'title' => 'Jam Operasional',
                        'items' => [
                            ['hari' => 'Senin - Jumat', 'jam' => '08:00 - 16:00 WITA'],
                            ['hari' => 'Sabtu', 'jam' => '08:00 - 12:00 WITA'],
                            ['hari' => 'Minggu', 'jam' => 'Tutup']
                        ]
                    ],
                    'social_media' => [
                        'title' => 'Media Sosial',
                        'items' => [
                            [
                                'name' => 'Facebook',
                                'url' => 'https://facebook.com/ponpestakalar',
                                'icon' => 'fab fa-facebook',
                                'color' => 'bg-blue-600'
                            ],
                            [
                                'name' => 'Instagram',
                                'url' => 'https://instagram.com/ponpestakalar',
                                'icon' => 'fab fa-instagram',
                                'color' => 'bg-pink-600'
                            ],
                            [
                                'name' => 'YouTube',
                                'url' => 'https://youtube.com/@ponpestakalar',
                                'icon' => 'fab fa-youtube',
                                'color' => 'bg-red-600'
                            ],
                            [
                                'name' => 'Twitter',
                                'url' => 'https://twitter.com/ponpestakalar',
                                'icon' => 'fab fa-twitter',
                                'color' => 'bg-sky-500'
                            ]
                        ]
                    ],
                    'maps' => [
                        'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.7426573428744!2d119.44444931476814!3d-5.416666996054892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMjUnMDAuMCJTIDExOcKwMjYnNDguMCJF!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid'
                    ]
                ]
            ]
        );

        // PPDB Page
        Page::updateOrCreate(
            ['slug' => 'ppdb'],
            [
                'title' => 'PPDB',
                'is_published' => true,
                'content' => [
                    'hero' => [
                        'badge' => 'Pendaftaran Dibuka!',
                        'title' => 'Penerimaan Peserta Didik Baru',
                        'subtitle' => 'Tahun Ajaran 2025/2026',
                        'description' => 'Bergabunglah dengan Pondok Pesantren Tahfidz Ahlul Jannah Takalar. Wujudkan impian menjadi penghafal Al-Quran yang berakhlak mulia.',
                        'background_image' => '/img/ppdb/hero-bg.png',
                    ],
                    'info' => [
                        'registration_period' => '1 Januari - 30 Juni 2025',
                        'registration_fee' => 'GRATIS',
                        'quota' => '100 Santri',
                    ],
                    'requirements' => [
                        'general' => [
                            'Lulus SD/MI atau sederajat',
                            'Usia maksimal 15 tahun pada bulan Juli',
                            'Sehat jasmani dan rohani',
                            'Bersedia tinggal di asrama',
                            'Siap mematuhi aturan pesantren',
                        ],
                        'documents' => [
                            'Fotocopy Ijazah SD/MI yang dilegalisir (2 lembar)',
                            'Fotocopy Akta Kelahiran (2 lembar)',
                            'Fotocopy Kartu Keluarga (2 lembar)',
                            'Pas foto berwarna 3x4 (4 lembar)',
                        ],
                    ],
                    'flow' => [
                        ['step' => 1, 'title' => 'Daftar Online', 'description' => 'Isi formulir pendaftaran melalui website resmi kami.'],
                        ['step' => 2, 'title' => 'Verifikasi Berkas', 'description' => 'Admin akan memverifikasi data dan berkas yang Anda kirimkan.'],
                        ['step' => 3, 'title' => 'Tes Masuk', 'description' => 'Ikuti tes seleksi masuk (baca Al-Quran & wawancara).'],
                        ['step' => 4, 'title' => 'Daftar Ulang', 'description' => 'Lakukan pembayaran dan validasi data final jika diterima.'],
                    ],
                    'brochure' => [
                        'title' => 'Unduh Brosur PPDB',
                        'description' => 'Dapatkan informasi lengkap mengenai kurikulum, fasilitas, kegiatan, dan rincian biaya pendidikan.',
                        'file_url' => null,
                    ],
                    'contact' => [
                        'whatsapp' => '6281234567890',
                    ],
                ]
            ]
        );
    }
}
