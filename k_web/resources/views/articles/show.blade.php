@extends('layouts.app')

@section('title', $article->title . ' - BlogKu')

@section('content')
<article class="container mx-auto px-6 py-12 max-w-4xl">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Article Header -->
        <div class="p-8 pb-0">
            <span class="inline-block bg-blue-100 text-blue-600 text-sm px-3 py-1 rounded-full mb-4">
                {{ $article->category }}
            </span>
            <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $article->title }}</h1>
            <div class="flex items-center text-gray-600 text-sm mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $article->formatted_date }}
            </div>
        </div>
        
        <!-- Article Image -->
        @if($article->image)
        <div class="px-8 py-6">
            <img src="{{ asset('storage/' . $article->image) }}" 
                 alt="{{ $article->title }}" 
                 class="w-full rounded-lg shadow-md">
        </div>

        
        @endif
        
        <!-- Article Content -->
        <div class="px-8 pb-8">
            <div class="prose max-w-none">
                <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{!! $article->description !!}</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="px-8 pb-8 flex gap-4">
            <a href="{{ route('articles.index') }}" 
               class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                ← Kembali ke Home
            </a>
            
            @auth
                <a href="{{ route('articles.edit', $article) }}" 
                   class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Edit Artikel
                </a>
            @endauth
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Artikel Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $related)
            <div class="bg-blue-700 rounded-lg shadow-md overflow-hidden transform transition duration-20 hover:shadow-lg hover:rotate-3">
                @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" 
                         alt="{{ $related->title }}" 
                         class="w-full h-48 object-cover">
                @else
                    <img src="https://via.placeholder.com/400x250" 
                         alt="{{ $related->title }}" 
                         class="w-full h-48 object-cover">
                @endif
                
                <div class="p-4">
                    
                    <h3 class="text-xl font-bold mb-2 text-white">{{ $related->title }}</h3>
                    <!-- <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $related->short_description }}</p> -->
                    <a href="{{ route('articles.show', $related) }}" 
                       class="text-white hover:text-yellow-400 font-semibold text-sm">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</article>
@endsection