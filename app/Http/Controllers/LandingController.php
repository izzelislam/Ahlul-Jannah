<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Program;
use App\Models\Structural;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->take(4)->get();
        $programs = Program::where('is_published', true)->orderBy('urutan')->get();
        $page = Page::where('slug', 'home')->first();
        
        return view('landing.index', compact('galleries', 'programs', 'page'));
    }

    public function profil()
    {
        $page = Page::where('slug', 'profil')->first();
        $structurals = Structural::orderBy('urutan', 'asc')->get();
        return view('landing.profil', compact('page', 'structurals'));
    }

    public function program()
    {
        $programs = Program::where('is_published', true)->orderBy('urutan')->get();
        return view('landing.program', compact('programs'));
    }

    public function galeri()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('landing.galeri', compact('galleries'));
    }

    public function kontak()
    {
        $page = Page::where('slug', 'kontak')->first();
        return view('landing.kontak', compact('page'));
    }

    public function pendaftaran()
    {
        $page = \App\Models\Page::where('slug', 'ppdb')->first();
        return view('landing.pendaftaran', compact('page'));
    }

    public function pendaftaranForm()
    {
        return view('landing.pendaftaran-form');
    }

    public function pendaftaranStore(Request $request)
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
        ]);

        // Set default status as pending
        $validated['status'] = 'pending';
        
        // Get current academic year (you can adjust this logic)
        $validated['academic_year_id'] = 1; // Default to 1 or get from settings

        \App\Models\Student::create($validated);

        return redirect()->route('landing.pendaftaran.form')->with('success', 'Pendaftaran berhasil! Kami akan menghubungi Anda segera.');
    }

    public function blog(Request $request)
    {
        $search = $request->get('search');
        $posts = Post::with('category', 'author')
            ->where('is_published', true)
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('landing.blog.index', compact('posts'));
    }

    public function blogDetail($slug)
    {
        $post = Post::with('category', 'author')
            ->where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related posts
        $relatedPosts = Post::where('is_published', true)
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('landing.blog.show', compact('post', 'relatedPosts'));
    }
}
