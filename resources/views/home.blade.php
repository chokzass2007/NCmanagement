@extends('layouts.admin')


@section('content')
    <div class="flex justify-center items-center min-h-[80vh] bg-gray-50">
        <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-2xl border border-gray-100">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 text-center">Manage Permissions</h1>
                <p class="text-gray-500 text-center mt-2">Configure role-based access control</p>
                <div class="container">
                    <h1 class="text-xl font-bold mb-4">Management Page</h1>
<span>hasPermission('Management', 'Delete')</span>
                    @if (hasPermission('Management', 'Delete'))
                    <button class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                    @else
                        <p class="text-gray-500">คุณไม่มีสิทธิ์ลบข้อมูล</p>
                    @endif

                    @if (hasPermission('Management', 'Editor'))
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
                    @endif
                    @if (hasPermission('Management', 'View'))
                    <button class="bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
