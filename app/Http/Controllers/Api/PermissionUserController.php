<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionUserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function syncPermissionsOfUser(string $id, Request $request) 
    {
       $response = $this->userRepository->syncPermissions($id, $request->permissions);
        if(!$response) {
            return response()->json(
                ['message' => 'Usuário não encontrado'],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(
            ['message' => 'Permissoes atualizadas com sucesso'],
            Response::HTTP_OK
        );
    }

    public function getPermissionsOfUser(string $id) 
    {
        if(!$this->userRepository->findById($id)) {
            return response()->json(
                ['message' => 'Usuário não encontrado'],
                Response::HTTP_NOT_FOUND
            );
        }

        $permissions = $this->userRepository->getPermissionsOfUserId($id);
        return PermissionResource::collection($permissions);
    }

   
}
