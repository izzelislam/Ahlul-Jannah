<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'name',
        'is_active',
        'registration_start',
        'registration_end',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'registration_start' => 'date',
        'registration_end' => 'date',
    ];

    // Accessor untuk kompatibilitas
    public function getYearAttribute()
    {
        return $this->tahun;
    }

    public function getNameAttribute($value)
    {
        return $value ?? 'Tahun Ajaran ' . $this->tahun;
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public static function getActive()
    {
        return static::where('is_active', true)->first();
    }
}
