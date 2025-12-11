<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data
        DB::table('programs')->truncate();

        $programs = [
            [
                'title' => 'TPA',
                'subtitle' => 'Taman Pendidikan Al-Qur\'an',
                'description' => 'Membentuk generasi Qur\'ani sejak dini dengan metode pembelajaran yang menyenangkan dan interaktif.',
                'content' => 'Taman Pendidikan Al-Qur\'an (TPA) Al-Madinah berfokus pada pengenalan huruf hijaiyah, bacaan dasar shalat, dan hafalan surat pendek.

Program Unggulan:
- Metode Iqro & Tilawati
- Hafalan Doa Harian
- Praktik Shalat Berjamaah
- Kisah Nabi & Rasul

Kami menerima santri mulai usia 4 tahun untuk dibimbing mengenal Islam dengan cara yang ceria.',
                'image' => null,
                'tags' => 'TPA,Anak,Al-Qur\'an',
                'urutan' => 1,
                'is_published' => 1,
            ],
            [
                'title' => 'TK Islam',
                'subtitle' => 'Taman Kanak-Kanak',
                'description' => 'Pendidikan usia dini yang memadukan kurikulum nasional dengan nilai-nilai keislaman.',
                'content' => 'TK Islam Al-Madinah mencetak generasi yang cerdas, ceria, dan berakhlak mulia.

Kurikulum:
- Tematik Terpadu
- Pembiasaan Ibadah
- Calistung Dasar
- Motorik Kasar & Halus

Fasilitas bermain yang aman dan edukatif mendukung tumbuh kembang anak secara optimal.',
                'image' => null,
                'tags' => 'TK,Paud,Usia Dini',
                'urutan' => 2,
                'is_published' => 1,
            ],
            [
                'title' => 'SD IT',
                'subtitle' => 'Sekolah Dasar Islam Terpadu',
                'description' => 'Sekolah dasar yang mencetak fondasi akademik yang kuat dan karakter Qur\'ani.',
                'content' => 'SD IT Al-Madinah mengintegrasikan kurikulum nasional dengan kurikulum diniyah.

Program Unggulan:
- Tahfidz Juz 30 & 29
- Bilingual (Arab & Inggris Dasar)
- Pramuka SIT
- Sains & Matematika

Target Lulusan: Siap melanjutkan ke jenjang SMP/Mts favorit dengan bekal agama yang baik.',
                'image' => null,
                'tags' => 'SD,Dasar,Islam Terpadu',
                'urutan' => 3,
                'is_published' => 1,
            ],
            [
                'title' => 'SMP IT',
                'subtitle' => 'Sekolah Menengah Pertama IT',
                'description' => 'Mempersiapkan remaja yang melek teknologi, hafal Al-Qur\'an, dan berprestasi.',
                'content' => 'SMP IT Al-Madinah fokus pada pengembangan sains, teknologi, dan akhlak.

Kurikulum:
- Kurikulum Merdeka
- Coding Dasar (Web & Logic)
- Tahfidz Target 5 Juz
- Leadership Camp

Siswa dididik untuk menjadi problem solver yang berlandaskan iman dan takwa.',
                'image' => null,
                'tags' => 'SMP,Menengah,IT',
                'urutan' => 4,
                'is_published' => 1,
            ],
            [
                'title' => 'SMA IT',
                'subtitle' => 'Sekolah Menengah Atas IT',
                'description' => 'Mencetak pemimpin masa depan yang ahli teknologi dan faqih dalam agama.',
                'content' => 'SMA IT Al-Madinah adalah jenjang pendidikan tingkat lanjut yang menyiapkan siswa masuk PTN/PTS favorit atau langsung berkarya.

Konsentrasi:
- Science (IPA)
- Software Engineering (RPL)

Program Khusus:
- Intensive Coding Bootcamp
- Persiapan UTBK
- Tahfidz Mutqin
- Entrepreneurship',
                'image' => null,
                'tags' => 'SMA,Atas,Teknologi',
                'urutan' => 5,
                'is_published' => 1,
            ],
            [
                'title' => 'Pondok Putra',
                'subtitle' => 'Asrama Santri Putra',
                'description' => 'Lingkungan asrama yang menempa kemandirian, kedisiplinan, dan ukhuwah islamiyah santri putra.',
                'content' => 'Program asrama khusus putra (ikhwan) yang didesain untuk membentuk pribadi yang tangguh dan disiplin.

Kegiatan:
- Qiyamullail Berjamaah
- Puasa Sunnah Senin Kamis
- Olahraga (Futsal, Archery, Renang)
- Kajian Kitab Kuning

Santri putra dididik untuk menjadi pemimpin keluarga dan umat di masa depan.',
                'image' => null,
                'tags' => 'Putra,Asrama,Mandiri',
                'urutan' => 6,
                'is_published' => 1,
            ],
            [
                'title' => 'Pondok Putri',
                'subtitle' => 'Asrama Santri Putri',
                'description' => 'Lingkungan asrama yang menjaga fitrah muslimah, santun, dan berprestasi.',
                'content' => 'Program asrama khusus putri (akhwat) dengan penjagaan adab dan suasana yang kondusif.

Kegiatan:
- Kajian Keputrian (Fiqih Wanita)
- Tata Boga & Menjahit (Life Skill)
- Tahsin & Tahfidz Intensif
- Public Speaking

Mencetak muslimah yang cerdas, shalihah, dan siap berkontribusi bagi masyarakat.',
                'image' => null,
                'tags' => 'Putri,Asrama,Muslimah',
                'urutan' => 7,
                'is_published' => 1,
            ],
        ];

        foreach ($programs as $program) {
            $program['slug'] = Str::slug($program['title']);
            $program['created_at'] = now();
            $program['updated_at'] = now();
            DB::table('programs')->insert($program);
        }
    }
}
