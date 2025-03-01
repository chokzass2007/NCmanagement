<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class CheckPermission
{

    public function handle(Request $request, Closure $next, $permission, $programName)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
        if (!$request->user()) {
            abort(403, 'Unauthorized: User not logged in.');
        }

        // ค้นหาโปรแกรมจากชื่อ
        $program = Program::where('name', $programName)->first();

        // ตรวจสอบว่าโปรแกรมมีอยู่หรือไม่
        if (!$program) {
            Log::error('Program not found:', ['programName' => $programName]);
            abort(404, 'Program not found.');
        }

        // Log ข้อมูลสำหรับ Debug
        Log::info('Checking permission:', [
            'user_id' => $request->user()->id,
            'permission' => $permission,
            'program_id' => $program->id,
            'program_name' => $program->name,
        ]);
// dd($program);

        // ตรวจสอบสิทธิ์ของผู้ใช้
        if (!$request->user()->hasPermission($permission, $program)) {
            Log::warning('ไม่ได้รับอนุญาต: ผู้ใช้ไม่มีสิทธิ์ :', [
                'user_id' => $request->user()->id,
                'permission' => $permission,
                'program_id' => $program->id,
            ]);
            abort(403, 'ไม่ได้รับอนุญาต: ผู้ใช้ไม่มีสิทธิ์.');
        }

        // อนุญาตให้เข้าถึง
        return $next($request);
    }
}
