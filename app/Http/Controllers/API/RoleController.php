<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Resources\RoleResource;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role ;
    }
    public function index()
    {
        $data =  $this->role->all();
         return RoleResource::collection($data);
    }
    public function store(RoleStoreRequest $request)
    {
        return  $this->role->create($request->validated(),$request->input('permissions'));
    }
    public function destroy($id)
    {
        return $this->role->destroy($id);
    }
}
