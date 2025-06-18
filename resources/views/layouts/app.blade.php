<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Sales</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Toggle dropdown USER
        function toggleUserDropdown() {
            const menu = document.getElementById("userDropdown");
            menu.classList.toggle("hidden");
        }

        // Toggle sidebar untuk layar kecil
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen md:flex overflow-y-auto">

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed z-30 inset-y-0 left-0 transform -translate-x-full md:translate-x-0 md:relative md:sticky w-64 bg-blue-600 text-white flex flex-col p-4 transition-transform duration-200 ease-in-out">
        <div class="text-center mb-6">
            <div class="text-lg font-semibold">{{ Auth::user()->name ?? 'User' }}</div>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Dashboard</a>
            <a href="{{ route('after-sales.index') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">List Data After Sales</a>
            <a href="{{ route('after-sales.create') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Input After Sales</a>
            <a href="{{ route('profile-merchant.index') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">List Merchant</a>
            <a href="{{ route('profile-merchant.create') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Input Profil Merchant</a>
            <a href="{{ route('monitoring-edc.indexEDC') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Progress Livin' Merchant dan EDC</a>
            <a href="{{ route('monitoring-edc.createEDC') }}" class="block bg-blue-500 p-2 rounded hover:bg-blue-400">Input Progress Livin' Merchant dan EDC</a>
        </nav>
    </aside>

    {{-- Overlay saat sidebar dibuka di mobile --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-20 md:hidden" onclick="toggleSidebar()"></div>

    {{-- Konten --}}
    <main class="flex-1 p-6 relative z-10 min-h-screen overflow-y-auto pb-24">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            {{-- Tombol Hamburger untuk layar kecil --}}
            <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <img src="/logo_bank.png" alt="Logo Bank Mandiri" class="h-9 mx-auto md:mx-0">

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
