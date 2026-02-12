<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'K_Web - Platform Berbagi Artikel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<nav class="navbar no-print">
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-blue-600">
                    <a href="{{ route('articles.index') }}">K_Web</a>
                </div>
                <div class="flex items-center gap-4">

                <!-- @auth
    <p style="color:green;">SUDAH LOGIN</p>
@else
    <p style="color:red;">BELUM LOGIN</p>
@endauth -->
                    @auth
                        <span class="text-gray-600">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Menu Horizontal -->
    <!-- <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="container mx-auto px-6">
            <ul class="flex space-x-0">
                <li>
                    <a href="{{ route('articles.index') }}" 
                       class="block px-8 py-4 text-white font-semibold hover:bg-blue-700 transition border-b-4 {{ request()->get('category') == '' || request()->get('category') == 'all' ? 'border-white' : 'border-blue-800' }} hover:border-white">
                        Home
                    </a>
                </li>
                @foreach(['Teknologi', 'Bisnis', 'Pendidikan', 'Lifestyle'] as $cat)
                <li>
                    <a href="{{ route('articles.index', ['category' => $cat]) }}" 
                       class="block px-8 py-4 text-white font-semibold hover:bg-blue-700 transition border-b-4 {{ request()->get('category') == $cat ? 'border-white' : 'border-blue-800' }} hover:border-white">
                        {{ $cat }}
                    </a>
                </li>
                @endforeach
                <li>
                    <a href="{{ route('articles.index', ['category' => 'all']) }}" 
                       class="block px-8 py-4 text-white font-semibold hover:bg-blue-700 transition border-b-4 border-blue-800 hover:border-white">
                        Semua Artikel
                    </a>
                </li>
            </ul>
        </div>
    </nav> -->

    <!-- Menu Horizontal -->
<nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between">

            <!-- MENU HALAMAN (HORIZONTAL) -->
            <ul class="flex items-center space-x-6">

                <li>
                    <a href="{{ route('articles.index') }}" 
                       class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('kslabel.index') }}" 
                       class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                        KS Label
                    </a>
                </li>
                <li>
                    <a href="{{ route('coverst.index') }}" 
                       class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                        Cover ST
                    </a>
                </li>

                <li>
                    <a href="{{ route('ba.ddr') }}" 
                       class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                        BA DDR-ST
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('articles.index', ['category' => 'all']) }}" 
                       class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                        Semua Artikel
                    </a>
                </li>

                <!-- DROPDOWN KATEGORI -->
                <li class="relative group">
                    <button class="py-4 text-white font-semibold hover:text-yellow-300 transition focus:outline-none">
                        Kategori Artikel ▼
                    </button>

                    <ul class="absolute left-0 mt-0 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300 z-50">
                        @foreach(['Stocktake', 'Keepstock', 'Lainnya'] as $cat)
                        <li>
                            <a href="{{ route('articles.index', ['category' => $cat]) }}" 
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                                {{ $cat }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
</nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="container mx-auto px-6 py-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mx-auto px-6 py-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Admin Panel -->
    @auth
    <section class="container mx-auto px-6 py-8">
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Panel Admin</h3>
                    <p class="text-gray-600">Anda login sebagai administrator</p>
                </div>
                <a href="{{ route('articles.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                    + Buat Artikel Baru
                </a>
            </div>
        </div>
    </section>
    @endauth

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
     <footer class="footer no-print">
    <footer class="bg-gray-800 text-white py-2 mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <!-- <h3 class="text-xl font-bold mb-4">Pengembangan Website</h3> -->
                <p class="text-gray-400 mb-4">© {{ date('Y') }} K_Web. Gustiar Dwi Saputra S</p>
                <!-- <div class="flex justify-center space-x-6"> -->
                    <!-- <a href="#" class="text-gray-400 hover:text-white transition">Tentang</a>
                    <a href="#" class="text-gray-400 hover:text-white transition">Kontak</a>
                    <a href="#" class="text-gray-400 hover:text-white transition">Privacy</a> -->
                <!-- </div> -->
            </div>
        </div>
    </footer>
</footer>
    @stack('scripts')
</body>
</html>