@extends('layouts.landing')

@section('title', 'Program Pendidikan')

@section('content')
    <section class="bg-slate-900 pt-32 pb-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-blue-900/50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">Jenjang Pendidikan</h1>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto">
                Lembaga Pendidikan Ahlul Jannah menyediakan pendidikan berkesinambungan mulai dari usia dini hingga menengah atas untuk Putra dan Putri.
            </p>
        </div>
    </section>

    <!-- Program List -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($programs as $program)
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-slate-100 hover:-translate-y-1 transition duration-300 flex flex-col h-full relative overflow-hidden group">
                        @if(Str::contains(strtolower($program->tags ?? ''), 'full day'))
                            <div class="absolute top-0 right-0 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-bl-xl">FULL DAY</div>
                        @endif

                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition duration-300 flex-shrink-0">
                            @if($program->image)
                                <img src="{{ Storage::url($program->image) }}" alt="{{ $program->title }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $program->title }}</h3>
                        <p class="text-primary-600 text-sm font-semibold mb-3">{{ $program->subtitle }}</p>
                        <p class="text-slate-600 mb-6 text-sm leading-relaxed flex-grow">
                            {{ Str::limit($program->content ?? $program->description, 150) }}
                        </p>
                        <div class="flex flex-wrap gap-2 text-sm text-slate-500 mt-auto">
                            @if($program->tags)
                                @foreach(explode(',', $program->tags) as $tag)
                                    <span class="bg-slate-100 px-2 py-1 rounded">{{ trim($tag) }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-slate-500">Belum ada program yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
