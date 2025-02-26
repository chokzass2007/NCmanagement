@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-100">
        <h1 class="text-3xl font-bold text-gray-900 text-center mb-4">Manage User Permissions</h1>
        <p class="text-gray-500 text-center mb-6">Remove specific permissions from users</p>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-4 text-left">User</th>
                        <th class="p-4 text-left">Role</th>
                        <th class="p-4 text-left">Program</th>
                        <th class="p-4 text-left">Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @foreach($user->roles as $role)
                            @foreach($role->programs as $program)
                                @foreach($role->permissions as $permission)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="p-4">{{ $user->name }} ({{ $user->email }})</td>
                                        <td class="p-4">{{ $role->name }}</td>
                                        <td class="p-4">{{ $program->name }}</td>
                                        <td class="p-4 flex items-center gap-2">
                                            <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded-full">{{ $permission->name }}</span>
                                            <form action="{{ route('removePermission') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                                <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs transition">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
