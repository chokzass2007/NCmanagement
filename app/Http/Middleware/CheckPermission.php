<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Program;
use App\Models\User;

class CheckPermission
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
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
            abort(404, 'Program not found.');
        }
// dd( $permission, $program);
        // ตรวจสอบสิทธิ์ของผู้ใช้
        if (!$request->user()->hasPermission($permission, $program)) {
            abort(403, 'Unauthorized: User does not have permission.');
        }

        // อนุญาตให้เข้าถึง
        return $next($request);
    }
}
