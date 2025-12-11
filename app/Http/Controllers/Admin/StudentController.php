<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('academicYear')->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $student->load('academicYear');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $academicYears = AcademicYear::orderBy('year', 'desc')->get();
        return view('admin.students.edit', compact('student', 'academicYears'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'sekolah_asal' => 'required|string|max:255',
            'status' => 'required|in:pending,verified,accepted,rejected',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function updateStatus(Request $request, Student $student)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,accepted,rejected'
        ]);

        $student->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }
}
