@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<section class="container mx-auto px-6 py-12 max-w-4xl">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Edit Artikel</h1>
        
        <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Judul -->
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    Judul Artikel <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $article->title) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('title') border-red-500 @enderror"
                       placeholder="Masukkan judul artikel...">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="category" class="block text-gray-700 font-semibold mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select id="category" 
                        name="category"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('category') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $article->category) == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image -->
            @if($article->image)
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Gambar Saat Ini</label>
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $article->image) }}" 
                         alt="{{ $article->title }}" 
                         class="max-w-md rounded-lg shadow-md">
                </div>
            </div>
            @endif

            <!-- Image Upload -->
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-semibold mb-2">
                    Ganti Gambar (Opsional)
                </label>
                <input type="file" 
                       id="image" 
                       name="image" 
                       accept="image/*"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('image') border-red-500 @enderror"
                       onchange="previewImage(event)">
                <p class="text-sm text-gray-500 mt-2">Format: JPG, PNG, GIF (Max 5MB)</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <img id="preview" src="" alt="Preview" class="max-w-md rounded-lg shadow-md">
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-semibold mb-2">
                    Deskripsi Artikel <span class="text-red-500">*</span>
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="15" 
                          maxlength="100000"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('description') border-red-500 @enderror"
                          placeholder="Tulis konten artikel Anda di sini (maksimal 100000 karakter)..."
                          oninput="updateCharCount()">{{ old('description', $article->description) }}</textarea>
                <div class="flex justify-between mt-2">
                    <p class="text-sm text-gray-500">Maksimal 100000 karakter</p>
                    <p id="charCount" class="text-sm text-gray-500">0/100000</p>
                </div>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Update Artikel
                </button>
                
                <button type="button" 
                        onclick="confirmDelete()"
                        class="bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                    Hapus Artikel
                </button>
                
                <a href="{{ route('articles.show', $article) }}" 
                   class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-400 transition inline-block text-center">
                    Batal
                </a>
            </div>
        </form>

        <!-- Delete Form (Hidden) -->
        <form id="deleteForm" action="{{ route('articles.destroy', $article) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</section>

@push('scripts')
<script>
    // Character counter
    function updateCharCount() {
        const textarea = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        const count = textarea.value.length;
        charCount.textContent = `${count}/100000`;
        
        if (count >= 100000) {
            charCount.classList.add('text-red-600');
        } else {
            charCount.classList.remove('text-red-600');
        }
    }

    // Image preview
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewDiv.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // Confirm delete
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Initialize character count
    updateCharCount();
</script>
@endpush
@endsection