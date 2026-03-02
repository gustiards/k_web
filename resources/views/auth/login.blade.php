@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<section class="container mx-auto px-6 py-12">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Login Admin</h1>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('email') border-red-500 @enderror"
                       placeholder="admin@example.com">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" 
                       id="password" 
                       name="password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('password') border-red-500 @enderror"
                       placeholder="Masukkan password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-700">Ingat Saya</span>
                </label>
            </div>

            <!-- Demo Login Info -->
            <!-- <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <p class="text-sm text-gray-700 font-semibold mb-2">Demo Login:</p>
                <p class="text-sm text-gray-600">Email: <strong>admin@blogku.com</strong></p>
                <p class="text-sm text-gray-600">Password: <strong>admin123</strong></p>
            </div> -->

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition flex-1">
                    Login
                </button>
                <a href="{{ route('articles.index') }}" 
                   class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-400 transition inline-block text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</section>
@endsection