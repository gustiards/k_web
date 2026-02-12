<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'K_Web - Platform Berbagi Artikel')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- 🔥 PRINT STYLE --}}
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">

    <!-- HEADER -->
    <header class="bg-white shadow-md no-print">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-blue-600">
                    <a href="{{ route('articles.index') }}">K_Web</a>
                </div>
                <div class="flex items-center gap-4">

                    @auth
                        <span class="text-gray-600">
                            Halo, <strong>{{ Auth::user()->name }}</strong>
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- MENU -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg no-print">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between">
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
                        <a href="{{ route('ba.st') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                            BA ST
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ba.ddr') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                           class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                            BA DDR-ST
                        </a>
                    </li>
                    <li>
                    <a href="{{ route('list.damage') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                        List Damage
                    </a>
                    <li>
                        <a href="{{ route('articles.index', ['category' => 'all']) }}"
                           class="block py-4 text-white font-semibold hover:text-yellow-300 transition">
                            Semua Artikel
                        </a>
                    </li>

                    <!-- DROPDOWN -->
                    <li class="relative group">
                        <button class="py-4 text-white font-semibold hover:text-yellow-300 transition">
                            Kategori Artikel ▼
                        </button>

                        <ul
                            class="absolute left-0 mt-0 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300 z-50">
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

    <!-- FLASH MESSAGE -->
    @if(session('success'))
    <div class="container mx-auto px-6 py-4 no-print">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mx-auto px-6 py-4 no-print">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- ADMIN PANEL -->
    @auth
    <section class="container mx-auto px-6 py-8 no-print">
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Panel Admin</h3>
                    <p class="text-gray-600">Anda login sebagai administrator</p>
                </div>
                <a href="{{ route('articles.create') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                    + Buat Artikel Baru
                </a>
            </div>
        </div>
    </section>
    @endauth

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-2 mt-16 no-print">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-400">
                © {{ date('Y') }} K_Web. Gustiar Dwi Saputra S
            </p>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>
