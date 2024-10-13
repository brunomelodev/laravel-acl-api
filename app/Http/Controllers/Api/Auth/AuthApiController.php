<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AuthApiRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Authenticate user and return a token.
     *
     * @param  \App\Http\Requests\Api\Auth\AuthApiRequest  $request
     * @return string
     */
    
/******  7e738939-c665-4ff3-bc9b-f2532a900422  *******/
    public function auth(AuthApiRequest $request)
    {
       
        $user = $this->userRepository->findByEmail($request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        //antes de criar o toker eu faço o delete para que não exista acesso simultaneo no sistema
        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function me(){

        $user = Auth::user();
        $user->load('permissions');
        return new UserResource($user);

    }

    public function logout()
    {
        //tokens gera erro pq estou usando a facade Auth (não tem login autenticado ainda)
        Auth::user()->tokens()->delete();

        return response()->json(
            [],
            Response::HTTP_NO_CONTENT
        );
    }

}
