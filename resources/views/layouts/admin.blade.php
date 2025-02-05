<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

<div x-data="{ isOpen: true }" class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div 
        :class="isOpen ? 'w-64' : 'w-20'" 
        class="bg-white shadow-lg h-full transition-all duration-300 flex flex-col border-r border-gray-100 relative"
    >
        <!-- Logo Section -->
        <div class="p-4 flex items-center justify-between border-b border-gray-100">
            <div class="flex items-center space-x-3" x-show="isOpen">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">A</span>
                </div>
                <span class="text-lg font-semibold text-gray-800">Admin Pro</span>
            </div>
            <button 
                @click="isOpen = !isOpen" 
                class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                :class="{'bg-gray-100': !isOpen}"
            >
                <i class="fas fa-bars text-gray-600"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-4 flex-1 px-2">
            <div class="space-y-1">
                <!-- Dashboard Link -->
                <a href="#" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                    <i class="fas fa-home" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                    <span x-show="isOpen" class="font-medium">Dashboard</span>
                    <span x-show="isOpen" class="ml-auto bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded-full text-xs">New</span>
                </a>

                <!-- Users Link -->
                <a href="{{route('Management')}}" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                    <i class="fas fa-users" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                    <span x-show="isOpen" class="font-medium">Users</span>
                </a>

                <!-- Analytics Link -->
                <a href="{{route('setPermission.program')}}" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                    <i class="fas fa-chart-line" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                    <span x-show="isOpen" class="font-medium">Manage Programs</span>
                </a>

                <!-- Projects Link -->
                <a href="#" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
                    <i class="fas fa-project-diagram" :class="isOpen ? 'w-5 mr-3' : 'w-5 mx-auto'"></i>
                    <span x-show="isOpen" class="font-medium">Projects</span>
                </a>
            </div>

            <!-- Settings Section -->
            <div class="mt-6">
                <h3 x-show="isOpen" class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Settings
                </h3>
                <div class="mt-2 space-y-1">
                    <a href="#" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 group">
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
                    <p class="text-sm font-medium text-gray-700">Admin User</p>
                    <p class="text-xs text-gray-500">admin@example.com</p>
                </div>
            </div>
            <div x-show="!isOpen" class="flex justify-center">
                <img src="https://ui-avatars.com/api/?name=Admin+User" class="w-8 h-8 rounded-full">
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div 
        class="flex-1 transition-all duration-300"
    >
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
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>