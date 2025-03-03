@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-100">
        <h1 class="text-3xl font-bold text-gray-900 text-center mb-4">Manage Individual Permissions</h1>
        <p class="text-gray-500 text-center mb-6">Remove specific permissions for users</p>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-4 text-left">User</th>
                        <th class="p-4 text-left">Role</th>
                        <th class="p-4 text-left">Program</th>
                        <th class="p-4 text-left">Permission</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $perm)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4">{{ $perm->user_name }}</td>
                            <td class="p-4">{{ $perm->role_name }}</td>
                            <td class="p-4">{{ $perm->program_name }}</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded-full">
                                    {{ $perm->permission_name }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('removePermission') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $perm->id }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm transition">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
