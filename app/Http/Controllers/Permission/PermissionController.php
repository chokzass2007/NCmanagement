<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Role;
use App\Models\Program;
use App\Models\Permission;
use Illuminate\Routing\Controller as BaseController;

class PermissionController extends BaseController
{
//public function dataJsonIndex(siloFG_viewRepositories $siloFG_viewRepositories){
//  $data = $siloFG_viewRepositories->getAll();
//  return response()->json($data);
//}
 public function index(PermissionRepository $permissionRepository)
 {
   
 } 
}
