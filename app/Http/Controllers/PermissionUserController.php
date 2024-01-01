<?php

namespace App\Http\Controllers;

use App\Http\Requests\SyncPermissionsUserRequest;
use App\Http\Resources\PermissionResource;
use App\Repositories\UserRepository;

class PermissionUserController extends Controller
{
    public function __construct(protected UserRepository $userRepository){}

    public function syncPermissionsUser(string $idUser, SyncPermissionsUserRequest $request)
    {
        $response = $this->userRepository->syncPermissions($idUser, $request->permissions);
        if(!$response){
            return response()->json(['message' => 'User Not Found'], 404);
        }
        return response()->json(['message' => 'Synced user permissions']);
    }

    public function getPermissionsUser(string $id)
    {
        if(!$this->userRepository->findById($id)){
            return response()->json(['message' => 'User Not Found'], 404);
        }
        $permissions = $this->userRepository->getPermissionsByUserId($id);
        return PermissionResource::collection($permissions);
    }
}
