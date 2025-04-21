<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NC Management</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img\NCmanangement.png') }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">

    <div x-data="{ isOpen: true }" class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <div :class="isOpen ? 'w-64' : 'w-20'"
            class="bg-white shadow-lg min-h-screen transition-all duration-300 flex flex-col border-r border-gray-100 relative">

            <!-- Logo Section -->
            <div class="p-4 flex items-center justify-between border-b border-gray-100">
                <div class="flex items-center space-x-3" x-show="isOpen">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">NC</span>
                    </div>
                    <span class="text-lg font-semibold text-gray-800">NC management</span>
                </div>
                <button @click="isOpen = !isOpen"
                    class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="mt-4 flex-1 px-2 overflow-y-auto">
                <div class="space-y-1">
                    <!-- Dashboard Link -->
                    <a href="{{ route('home') }}"
                        class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                        <i class="fas fa-home" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                        <span x-show="isOpen" class="font-medium">Dashboard</span>
                    </a>

                    <!-- Users Link -->
                    <a href="{{ route('Management') }}"
                        class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                        <i class="fas fa-users" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                        <span x-show="isOpen" class="font-medium">Users</span>
                    </a>

                    <!-- Program Link -->
                    <a href="{{ route('setPermission.program') }}"
                        class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                        <i class="fas fa-project-diagram" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                        <span x-show="isOpen" class="font-medium">Program</span>
                    </a>
                    <!-- Permission Link -->
                    <a href="{{ route('setPermission.permission') }}"
                        class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                        <i class="fas fa-chart-line" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                        <span x-show="isOpen" class="font-medium">Permission</span>
                    </a>
                      <!-- Role Link -->
                      <a href="{{ route('setrole.role') }}"
                      class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                      <i class="fas fa-chart-line" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                      <span x-show="isOpen" class="font-medium">Role</span>
                  </a>
                    <!-- Analytics Link -->
                    <a href="{{ route('ManageProgram') }}"
                        class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                        <i class="fas fa-chart-line" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                        <span x-show="isOpen" class="font-medium">Manage Permission</span>
                    </a>

                </div>

                <!-- Settings Section -->
                <div class="mt-6">
                    <h3 x-show="isOpen" class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Settings
                    </h3>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                            <i class="fas fa-cog" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                            <span x-show="isOpen" class="font-medium">Settings</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="border-t border-gray-100 p-4 mt-auto">
                <div class="flex items-center" x-show="isOpen">
                    <img src="https://ui-avatars.com/api/?name=Admin+User" class="w-8 h-8 rounded-full">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div x-show="!isOpen" class="flex justify-center">
                    <img src="https://ui-avatars.com/api/?name=Admin+User" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-bell text-gray-600"></i>
                        </button>
                        <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-search text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-grow">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="text-black text-center p-4">
                © Copyright 2025 by <a class="text-blue-500 underline" href="https://www.facebook.com/CJdc2011/"
                    target="_blank">Numchok.</a> Licensed under
                <a href="https://en.wikipedia.org/wiki/Creative_Commons_NonCommercial_license" target="_blank"
                    class="text-blue-500 underline">
                    CC BY-NC 4.0
                </a>. Free to share but not for commercial use.
            </footer>
        </div>
    </div>

</body>

</html>
