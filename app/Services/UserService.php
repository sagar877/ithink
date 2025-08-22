<?php

namespace App\Services;

use App\BO\UserBO;
use Illuminate\Support\Facades\Cache;

class UserService
{
    protected $userBO;

    public function __construct(UserBO $userBO)
    {
        $this->userBO = $userBO;
    }

     public function createUser(array $data)
    {
        $user = $this->userBO->createUser($data);
        Cache::put("user_{$user->id}", $user);
        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $updatedUser = $this->userBO->updateUser($id, $data);
        Cache::put("user_{$id}", $updatedUser);
        return $updatedUser;
    }

    public function getUser(int $id)
    {
        return Cache::remember("user_{$id}", 3600, fn () => $this->userBO->getUserById($id));
    }

    public function getAllUsers()
    {
        return Cache::remember('all_users', 3600, fn () => $this->userBO->getAllUsers());
    }

    public function deleteUser(int $id)
    {
        $user = $this->userBO->getUserById($id);

        if ($user) {
            Cache::forget("user_{$id}");
            return $this->userBO->deleteUser($id);
        }

        return false;
    }
}
