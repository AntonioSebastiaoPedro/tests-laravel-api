<?php
namespace App\Repositories;

use App\DTOs\Permissions\CreatePermissionDTO;
use App\DTOs\Permissions\EditPermissionDTO;
use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionRepository
{
    public function __construct(protected Permission $permission)
    {}

    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''): LengthAwarePaginator
    {
        return $this->permission->where(function ($query) use ($filter){
            if($filter !== ''){
                $query->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%");
            }
        })->paginate($totalPerPage, ['*'], $page);
    }

    public function findtById(string $id): ?Permission
    {
        return $this->permission->find($id);
    }

    public function createNew(CreatePermissionDTO $permissionDTO): Permission
    {
        return $this->permission->create((array) $permissionDTO);
    }

    public function update(EditPermissionDTO $permissionDTO): bool
    {
        if(!$permission = $this->findtById($permissionDTO->id)){
            return false;
        }
        return $permission->update((array) $permissionDTO);
    }

    public function delete(string $id): bool
    {
        if(!$permission = $this->findtById($id)){
            return false;
        }
        return $permission->delete();
    }
}