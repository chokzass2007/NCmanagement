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

    public function ManageProgram(ProgramRepository $programRepository)
    {
        return $programRepository->ManageProgram();
    }

    public function program(ProgramRepository $programRepository)
    {
        return $programRepository->program();
    }
    public function permission(ProgramRepository $programRepository)
    {
        return $programRepository->permission();
    }
    public function role(ProgramRepository $programRepository)
    {
        return $programRepository->role();
    }

    public function destroy(ProgramRepository $programRepository, $id)
    {
        return $programRepository->destroyProgram($id);
    }
    public function destroyPermission(ProgramRepository $programRepository, $id)
    {
        return $programRepository->destroyPermission($id);
    }
    public function destroyRole(ProgramRepository $programRepository, $id)
    {
        return $programRepository->destroyRole($id);
    }

    public function storePermission(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->storePermissions($request);
    }
    
    public function storeRole(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->storeRole($request);
    }
    
    public function ManagementStore(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->ManagementStore($request);
    }

    public function removePermission(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->removePermission($request);
    }
    public function removeRole(ProgramRepository $programRepository, Request $request)
    {
        return $programRepository->removeRole($request);
    }
}
