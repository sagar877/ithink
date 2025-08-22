<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function list(): JsonResponse
    {
        $data = $this->userService->getAllUsers();

        return response()->json(['data' => $data]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $userData = $request->validated();
        $user = $this->userService->createUser($userData);
        return response()->json(['data' => $user], 201);
    }

    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        $updatedData = $request->validated();
        $user = $this->userService->updateUser($id, $updatedData);
        
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        return response()->json(['data' => $user]);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->getUser($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        return response()->json(['data' => $user]);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userService->getUser($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $this->userService->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }

}

