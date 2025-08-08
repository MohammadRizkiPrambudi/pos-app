<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Pos App')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <div class="navbar bg-base-100 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="btn btn-ghost text-xl flex items-center gap-2">
                <i data-lucide="shopping-bag"></i>
                Pos App
            </a>
            <div class="hidden md:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{ url('/') }}"><i data-lucide="home" class="w-4 h-4"></i> Home</a></li>
                    <li><a href="{{ url('/barang') }}"><i data-lucide="package" class="w-4 h-4"></i> Barang</a></li>
                    <li>
                        <details>
                            <summary><i data-lucide="shopping-cart" class="w-4 h-4"></i> Transaksi</summary>
                            <ul class="bg-base-100 rounded-t-none p-2">
                                <li><a href="{{ url('/kasir') }}"><i data-lucide="credit-card" class="w-4 h-4"></i>
                                        Kasir</a></li>
                                <li><a href="{{ url('/riwayat') }}"><i data-lucide="clock" class="w-4 h-4"></i>
                                        Riwayat</a></li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
            {{-- Mobile menu --}}
            <div class="dropdown md:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <i data-lucide="menu"></i>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box right-0 w-52">
                    <li><a href="{{ url('/') }}"><i data-lucide="home" class="w-4 h-4"></i> Home</a></li>
                    <li><a href="{{ url('/barang') }}"><i data-lucide="package" class="w-4 h-4"></i> Barang</a></li>
                    <li><a href="{{ url('/kasir') }}"><i data-lucide="credit-card" class="w-4 h-4"></i> Kasir</a></li>
                    <li><a href="{{ url('/riwayat') }}"><i data-lucide="clock" class="w-4 h-4"></i> Riwayat</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Konten Halaman --}}
    <main class="p-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer sm:footer-horizontal footer-center bg-base-300 text-base-content p-4 pt-6">
        <aside>
            <p>Copyright © {{ date('Y') }} - Mohammad Rizki Prambudi</p>
        </aside>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
