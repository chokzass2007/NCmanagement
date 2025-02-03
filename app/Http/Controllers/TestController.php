<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\User;

class TestController extends Controller
{
    public function viewProgramAA(Request $request)
    {

        $user = $request->user();
        // dd($user);
        $program = Program::where('name', 'ProgramA')->first();
        
        // dd($user->hasPermission('ProgramA', $program));
        if ($user->hasPermission('view', $program)) {
            // แสดงโปรแกรม
            return view('programA');
        } else {
            // ไม่อนุญาต
            abort(403);
        }
    }

    public function editProgramBB(Request $request)
    {
        $user = $request->user();
        $program = Program::where('name', 'programnameB')->first();

        if ($user->hasPermission('edit_programname', $program)) {
            // แก้ไขโปรแกรม
            return view('editProgramB');
        } else {
            // ไม่อนุญาต
            abort(403);
        }
    }
}
