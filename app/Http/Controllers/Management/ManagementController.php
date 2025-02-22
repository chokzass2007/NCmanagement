<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;


use Illuminate\Routing\Controller as BaseController;

class ManagementController extends BaseController
{
    public function index(ProgramRepository $programRepository)
    {
        return $programRepository->main();
    }

    public function program(ProgramRepository $programRepository)
    {
        return $programRepository->program();
    }

    public function destroy(ProgramRepository $programRepository, $id)
    {
        return $programRepository->destroyProgram($id);
    }

    public function store(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->store($request);
    }
    
    public function ManagementStore(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->ManagementStore($request);
    }
}
