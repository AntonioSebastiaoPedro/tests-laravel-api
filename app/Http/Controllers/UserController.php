<?php

namespace App\Http\Controllers;

use App\DTOs\Users\{CreateUserDTO, EditUserDTO};
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __construct(private UserRepository $userRepository)
    {
        
    }

    public function index(Request $request)
    {
        $users =  $this->userRepository->getPaginate(
            totalPerPage: $request->total_per_page ?? 15,
            page: $request->page ?? 1,
            filter: $request->filter ?? ''
        );

        return UserResource::collection($users);
    }

    
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->createNew(New CreateUserDTO(...$request->validated()));
        return new UserResource($user);
    }

    
    public function show(string $id)
    {  
        if(!$user = $this->userRepository->findById($id)){
            return response()->json(['message' => 'User Not Found'], 404);
        }
        return new UserResource($user);
    }

    
    public function update(UpdateUserRequest $request, string $id)
    {
        
        $updateUser = $this->userRepository->update(
                    new EditUserDTO(...[$id, ...$request->validated()])
                );
        if(!$updateUser){
            return response()->json(['message' => 'User Not Found'], 404);
        }
        return response()->json([
            'message' => 'User Updated Successfuly',
        ]);
    }

    
    public function destroy(string $id)
    {
        if(!$this->userRepository->delete($id)){
            return response()->json(['message' => 'User Not Found'], 404);
        }
        return response()->json([], 204);
    }
}
