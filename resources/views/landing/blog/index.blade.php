@extends('layouts.landing')

@section('title', 'Berita & Artikel')

@section('content')
    <section class="bg-primary-50 pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">Berita & Artikel</h1>
            <p class="text-slate-600 max-w-2xl mx-auto">Informasi terbaru seputar kegiatan, prestasi, dan wawasan Islam dari Pondok Informatika Al-Madinah.</p>
            
            <!-- Search -->
            <div class="mt-8 max-w-md mx-auto">
                <form action="{{ route('landing.blog') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..." class="w-full px-6 py-3 rounded-full border border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
                    <button type="submit" class="absolute right-2 top-2 p-1.5 bg-primary-600 text-white rounded-full hover:bg-primary-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:-translate-y-1 transition duration-300 flex flex-col">
                        <div class="relative h-48 overflow-hidden group">
                           @if($post->thumbnail)
                                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                           @else
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                           @endif
                           <div class="absolute top-4 left-4">
                               <span class="px-3 py-1 bg-white/90 backdrop-blur text-xs font-bold text-primary-600 rounded-full shadow-sm">
                                   {{ $post->category->name ?? 'Uncategorized' }}
                               </span>
                           </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center text-xs text-slate-500 mb-3 gap-4">
                                <span class="flex items-center gap-1"><i class="far fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                                <span class="flex items-center gap-1"><i class="far fa-user"></i> {{ $post->author->name ?? 'Admin' }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2">
                                <a href="{{ route('landing.blog.show', $post->slug) }}" class="hover:text-primary-600 transition">{{ $post->title }}</a>
                            </h3>
                            <p class="text-slate-600 text-sm mb-4 line-clamp-3 leading-relaxed flex-1">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('landing.blog.show', $post->slug) }}" class="inline-flex items-center text-primary-600 font-semibold text-sm hover:text-primary-700 mt-auto">
                                Baca Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4 text-slate-400">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900">Belum ada artikel</h3>
                        <p class="text-slate-500">Silakan kembali lagi nanti untuk informasi terbaru.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
