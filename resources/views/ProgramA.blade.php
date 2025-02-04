@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-2xl">
        <h1 class="text-2xl font-semibold text-center mb-4">Manage Permissions</h1>

        <form action="" method="POST">
            @csrf

            <!-- เลือก Role -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-2">Select Role:</label>
                <select id="role" name="role_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- เลือก Program -->
            <div class="mb-4">
                <label for="program" class="block text-gray-700 font-medium mb-2">Select Program:</label>
                <select id="program" name="program_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- เลือก Permission -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Assign Permissions:</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($permissions as $permission)
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-2">
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- ปุ่ม Submit -->
            <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Save Permissions
            </button>
        </form>
    </div>
</div>
@endsection
