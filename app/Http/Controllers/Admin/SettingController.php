<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $menuSettings = [
            'menu_home' => 'Home',
            'menu_profil' => 'Profil',
            'menu_program' => 'Program',
            'menu_ppdb' => 'PPDB',
            'menu_galeri' => 'Galeri',
            'menu_blog' => 'Blog',
            'menu_kontak' => 'Kontak',
        ];

        $settings = [];
        foreach ($menuSettings as $key => $label) {
            $setting = Setting::where('key', $key)->first();
            $settings[$key] = [
                'label' => $label,
                'enabled' => $setting ? json_decode($setting->value, true) : true
            ];
        }

        // Get theme colors
        $primaryColor = Setting::get('theme_primary_color', '#2563eb');
        $secondaryColor = Setting::get('theme_secondary_color', '#1c7ed6');

        return view('admin.settings.index', compact('settings', 'primaryColor', 'secondaryColor'));
    }

    public function update(Request $request)
    {
        $menuKeys = [
            'menu_home',
            'menu_profil',
            'menu_program',
            'menu_ppdb',
            'menu_galeri',
            'menu_blog',
            'menu_kontak',
        ];

        foreach ($menuKeys as $key) {
            $value = $request->has($key);
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => json_encode($value)]
            );
        }

        // Update theme colors
        if ($request->has('theme_primary_color')) {
            Setting::updateOrCreate(
                ['key' => 'theme_primary_color'],
                ['value' => json_encode($request->theme_primary_color)]
            );
        }

        if ($request->has('theme_secondary_color')) {
            Setting::updateOrCreate(
                ['key' => 'theme_secondary_color'],
                ['value' => json_encode($request->theme_secondary_color)]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function reset(Request $request)
    {
        // Reset to default colors
        Setting::updateOrCreate(
            ['key' => 'theme_primary_color'],
            ['value' => json_encode('#2563eb')]
        );

        Setting::updateOrCreate(
            ['key' => 'theme_secondary_color'],
            ['value' => json_encode('#1c7ed6')]
        );

        return redirect()->route('admin.settings.index')->with('success', 'Warna tema berhasil direset ke default.');
    }
}
