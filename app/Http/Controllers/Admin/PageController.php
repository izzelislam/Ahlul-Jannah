<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|array',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dibuat.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function editBySlug($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|array',
            'content.hero.image' => 'nullable|image|max:2048',
            'content.about.image_1' => 'nullable|image|max:2048',
            'content.about.image_2' => 'nullable|image|max:2048',
        ]);

        $content = $request->input('content', []);

        // Handle File Uploads & Preserve Old Images
        // Hero Image
        if ($request->hasFile('content.hero.image')) {
            $content['hero']['image'] = $request->file('content.hero.image')->store('pages', 'public');
        } elseif (isset($page->content['hero']['image'])) {
            $content['hero']['image'] = $page->content['hero']['image'];
        }

        // About Image 1
        if ($request->hasFile('content.about.image_1')) {
            $content['about']['image_1'] = $request->file('content.about.image_1')->store('pages', 'public');
        } elseif (isset($page->content['about']['image_1'])) {
            $content['about']['image_1'] = $page->content['about']['image_1'];
        }

        // About Image 2
        if ($request->hasFile('content.about.image_2')) {
            $content['about']['image_2'] = $request->file('content.about.image_2')->store('pages', 'public');
        } elseif (isset($page->content['about']['image_2'])) {
            $content['about']['image_2'] = $page->content['about']['image_2'];
        }

        // Brochure Image (PPDB)
        if ($request->hasFile('content.brochure.image')) {
            $content['brochure']['image'] = $request->file('content.brochure.image')->store('pages/ppdb', 'public');
        } elseif (isset($page->content['brochure']['image'])) {
            $content['brochure']['image'] = $page->content['brochure']['image'];
        }

        // Clean up features lists (remove empty strings)
        if (isset($content['hero']['features']) && is_array($content['hero']['features'])) {
            $content['hero']['features'] = array_values(array_filter($content['hero']['features'], fn($v) => !empty($v)));
        }

        // Process PPDB requirements text to arrays
        if ($page->slug === 'ppdb') {
            if (isset($content['requirements']['general_text'])) {
                $content['requirements']['general'] = array_values(array_filter(
                    array_map('trim', explode("\n", $content['requirements']['general_text'])),
                    fn($v) => !empty($v)
                ));
                unset($content['requirements']['general_text']);
            }
            if (isset($content['requirements']['documents_text'])) {
                $content['requirements']['documents'] = array_values(array_filter(
                    array_map('trim', explode("\n", $content['requirements']['documents_text'])),
                    fn($v) => !empty($v)
                ));
                unset($content['requirements']['documents_text']);
            }
        }

        $page->update([
            'title' => $request->title,
            'content' => $content,
            'is_published' => $request->has('is_published'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus.');
    }
}
