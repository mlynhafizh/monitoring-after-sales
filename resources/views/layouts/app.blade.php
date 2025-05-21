<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitoring Sales</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind --}}
    <script>
        // Toggle dropdown USER
        function toggleUserDropdown() {
            const menu = document.getElementById("userDropdown");
            menu.classList.toggle("hidden");
        }
    </script>
</head>
<body class="flex bg-gray-100 min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-blue-600 text-white flex flex-col p-4 h-screen sticky top-0 left-0 z-20">
        <div class="text-center mb-6">
            <div class="text-lg font-semibold">{{ Auth::user()->name ?? 'User' }}</div>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Dashboard</a>
            <a href="{{ route('after-sales.index') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">List Data After Sales</a>
            <a href="{{ route('after-sales.create') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Input After Sales</a>
            <a href="{{ route('profile-merchant.index') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">List Merchant</a>
            <a href="{{ route('profile-merchant.create') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Input Profil Merchant</a>
        </nav>
    </aside>

    {{-- Konten --}}
    <main class="flex-1 p-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <img src="/logo_bank.png" alt="Logo Bank Mandiri" class="h-9">

            {{-- Dropdown USER --}}
            <div class="relative">
                <button onclick="toggleUserDropdown()" class="text-gray-700 font-semibold focus:outline-none">
                    {{ Auth::user()->name ?? 'User' }} ▼
                </button>
                <div id="userDropdown" class="absolute right-0 mt-2 w-40 bg-white rounded shadow-md hidden z-10">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-800">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm text-gray-800">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Konten Dinamis --}}
        @yield('content')
    </main>

    {{-- Script Tambahan --}}
    @yield('scripts')

</body>
</html>
