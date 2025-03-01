@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manage permission</h1>
        <p class="text-gray-500 mt-2">Add, view, and manage program listings</p>
    </div>

    <!-- Add Program Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Add New Program</h2>
        <form action="{{ route('permission.store') }}" method="POST" class="flex gap-3">
            @csrf
            <div class="flex-1">
                <input 
                    type="text" 
                    name="name" 
                    placeholder="Enter program name" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-colors duration-200"
                    required
                >
            </div>
            <button type="submit" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium transition-colors duration-200">
                <i class="ri-add-line"></i>
                Add Program
            </button>
        </form>
    </div>

    <!-- permission List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Program List</h2>
            <p class="text-gray-500 text-sm mt-1">{{ count($permission) }} permission total</p>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse ($permission as $program)
                <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <i class="ri-layout-2-line text-gray-400 text-xl"></i>
                        <span class="font-medium text-gray-700">{{ $program->name }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="#" class="text-gray-400 hover:text-blue-600 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                            <i class="ri-pencil-line"></i>
                        </a>
                        <form action="{{ route('permission.destroy', $program->id) }}" method="POST" class="inline">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" 
                                class="text-gray-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200"
                                onclick="return confirm('Are you sure you want to delete this program?')"
                            >
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <i class="ri-folder-open-line text-4xl text-gray-400 mb-3"></i>
                    <p class="text-gray-500 mb-1">No permission found</p>
                    <p class="text-sm text-gray-400">Add your first program using the form above</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add this to your layout file or view for icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">

@if (session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" 
         x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 3000)">
        {{ session('success') }}
    </div>
@endif
@endsection