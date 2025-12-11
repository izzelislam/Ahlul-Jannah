@extends('layouts.landing')

@section('title', $post->title)

@section('content')
    <!-- Progress Bar (Optional) -->
    <div class="fixed top-0 left-0 h-1 bg-primary-600 z-[60]" id="progressBar" style="width: 0%"></div>

    <section class="pt-32 pb-12 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                 <a href="{{ route('landing.blog') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-primary-600 transition mb-6">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Blog
                </a>
               <div class="flex items-center gap-2 mb-4">
                   <span class="px-3 py-1 bg-primary-100 text-primary-700 text-xs font-bold rounded-full uppercase tracking-wider">
                       {{ $post->category->name ?? 'News' }}
                   </span>
                   <span class="text-slate-400 text-sm">•</span>
                   <span class="text-slate-500 text-sm">{{ $post->created_at->format('d F Y') }}</span>
               </div>
               <h1 class="text-3xl md:text-5xl font-bold text-slate-900 leading-tight mb-6">
                   {{ $post->title }}
               </h1>
               <div class="flex items-center gap-3">
                   <div class="w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center text-slate-500 font-bold overflow-hidden">
                        @if($post->author && method_exists($post->author, 'profile_photo_url') && $post->author->profile_photo_url)
                             <img src="{{ $post->author->profile_photo_url }}" alt="{{ $post->author->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($post->author->name ?? 'A', 0, 1) }}
                        @endif
                   </div>
                   <div>
                       <p class="text-sm font-bold text-slate-900">{{ $post->author->name ?? 'Admin' }}</p>
                       <p class="text-xs text-slate-500">Penulis</p>
                   </div>
               </div>
            </div>
            
            @if($post->thumbnail)
            <div class="rounded-2xl overflow-hidden shadow-lg mb-10">
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full object-cover max-h-[500px]">
            </div>
            @endif

            <article class="prose prose-lg prose-slate max-w-none bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-slate-100">
                {!! $post->content !!}
            </article>
            
            <!-- Share (Simple) -->
            <div class="mt-8 border-t border-slate-200 pt-8 flex items-center gap-4">
                <span class="font-bold text-slate-700">Bagikan:</span>
                <a href="#" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
    <section class="py-16 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-slate-900 mb-8">Artikel Terkait</h3>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                     <a href="{{ route('landing.blog.show', $related->slug) }}" class="group block">
                        <div class="rounded-xl overflow-hidden aspect-video bg-slate-100 mb-4 relative">
                             @if($related->thumbnail)
                                <img src="{{ Storage::url($related->thumbnail) }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                             @endif
                        </div>
                        <h4 class="font-bold text-slate-900 group-hover:text-primary-600 transition line-clamp-2 mb-1">{{ $related->title }}</h4>
                        <p class="text-sm text-slate-500">{{ $related->created_at->format('d M Y') }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    
    @push('scripts')
    <script>
        // Simple progress bar
        window.onscroll = function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        };
    </script>
    @endpush
@endsection
