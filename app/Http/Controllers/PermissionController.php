<?php

namespace App\Http\Controllers;

use App\DTOs\Permissions\CreatePermissionDTO;
use App\DTOs\Permissions\EditPermissionDTO;
use App\Http\Requests\StoreUpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(protected PermissionRepository $permissionRepository){}
    
    public function index(Request $request)
    {
        $permissions = $this->permissionRepository->getPaginate(
            totalPerPage: $request->total_per_page ?? 15,
            page: $request->page ?? 1,
            filter: $request->filter ?? '',
        );
        return PermissionResource::collection($permissions);
    }

    
    public function store(StoreUpdatePermissionRequest $request)
    {
           $user = $this->permissionRepository->createNew(new CreatePermissionDTO(...$request->validated()));
           return new PermissionResource($user);
    }

    
    public function show(string $id)
    {
        if(!$user = $this->permissionRepository->findtById($id)){
            return response()->json(['message' => 'Permission Not Found'], 404);
        }
        return new PermissionResource($user);
    }

    
    public function update(StoreUpdatePermissionRequest $request, string $id)
    {
        $permissionUpdate = $this->permissionRepository->update(
                                new EditPermissionDTO(...[$id, ...$request->validated()])
                            );
        if(!$permissionUpdate){
            return response()->json(['message' => 'Permission Not Found'], 404);
        }
        return response()->json(['message' => 'Permission Updated Successfuly']);
    }


    public function destroy(string $id)
    {
        if(!$this->permissionRepository->delete($id)){
            return response()->json(['message' => 'Permission Not Found'], 404);
        }
        return response()->json([], 204);
    }
}
