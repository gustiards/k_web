@extends('layouts.app')

@section('title', 'Home - K_Web')

@section('content')
<!-- Hero Section
<section class="bg-gradient-to-r from-gray-100 to-gray-200 py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold mb-4 text-gray-800">Selamat Datang di K_Web</h1>
        <p class="text-xl text-gray-600 mb-8">Semoga Bermanfaat !</p>
    </div>
</section> -->

<!-- Articles Section -->
<section class="container mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">
            @if($category && $category !== 'all')
                Kategori: {{ $category }}
            @else
                Artikel Terbaru
            @endif
        </h2>
    </div>

   @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($articles as $article)
        <div class="bg-blue-700 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 hover:-rotate-1 hover:scale-105">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" 
                     alt="{{ $article->title }}" 
                     class="w-full h-48 object-cover">
            @else
                <img src="https://via.placeholder.com/400x250" 
                     alt="{{ $article->title }}" 
                     class="w-full h-48 object-cover">
            @endif
                
                <div class="p-6">
                    <span class="inline-block bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white text-xs px-3 py-1 rounded-full mb-2">
                        {{ $article->category }}
                    </span>
                    <h3 class="text-xl font-bold mb-2 text-white">{{ $article->title }}</h3>
                    <!-- <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->short_description }}</p> -->
                    
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('articles.show', $article) }}" 
                           class="text-white hover:text-yellow-400 font-semibold text-sm">
                            Baca Selengkapnya →
                        </a>
                        
                        @auth
                            <a href="{{ route('articles.edit', $article) }}" 
                               class="text-green-600 hover:text-green-800 font-semibold ml-auto">
                                Edit
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg mb-4">Belum ada artikel dalam kategori ini</p>
            @auth
                <a href="{{ route('articles.create') }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition inline-block">
                    Tulis Artikel Pertama
                </a>
            @endauth
        </div>
    @endif
</section>
@endsection