<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_pendaftar' => Student::count(),
            'pendaftar_pending' => Student::where('status', 'pending')->count(),
            'pendaftar_diterima' => Student::where('status', 'accepted')->count(),
            'pendaftar_ditolak' => Student::where('status', 'rejected')->count(),
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'total_galleries' => Gallery::count(),
            'total_programs' => Program::count(),
        ];

        // Get active academic year
        $activeYear = AcademicYear::where('is_active', true)->first();

        // Recent registrations
        $recentStudents = Student::with('academicYear')
            ->latest()
            ->take(5)
            ->get();

        // Registrations by status (for chart)
        $registrationsByStatus = [
            'pending' => Student::where('status', 'pending')->count(),
            'verified' => Student::where('status', 'verified')->count(),
            'accepted' => Student::where('status', 'accepted')->count(),
            'rejected' => Student::where('status', 'rejected')->count(),
        ];

        // Gender distribution
        $genderStats = [
            'laki' => Student::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Student::where('jenis_kelamin', 'P')->count(),
        ];

        return view('admin.dashboard.index', compact(
            'stats',
            'activeYear',
            'recentStudents',
            'registrationsByStatus',
            'genderStats'
        ));
    }
}
