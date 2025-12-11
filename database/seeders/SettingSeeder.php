<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuSettings = [
            'menu_home' => true,
            'menu_profil' => true,
            'menu_program' => true,
            'menu_ppdb' => true,
            'menu_galeri' => true,
            'menu_blog' => true,
            'menu_kontak' => true,
        ];

        foreach ($menuSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => json_encode($value)]
            );
        }

        // Theme Color Settings
        $themeSettings = [
            'theme_primary_color' => '#2563eb',  // primary-600
            'theme_secondary_color' => '#1c7ed6',
        ];

        foreach ($themeSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => json_encode($value)]
            );
        }
    }
}
