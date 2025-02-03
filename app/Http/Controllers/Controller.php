<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


 class Controller 
{
    public function viewProgramA(TestController $testController, Request $request)
    {
        // dd($request);
        return $testController->viewProgramAA($request);
    }

    public function editProgramB(TestController $testController, Request $request)
    {
        return $testController->editProgramBB($request);
    }
}
