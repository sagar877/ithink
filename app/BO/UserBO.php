<?php

namespace App\BO;
use App\Dao\UserDao;

class UserBO
{
    protected $userDao;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userDao->create($data);
    }

    public function getUserById(int $id)
    {
        return $this->userDao->findById($id);
    }

    public function updateUser(int $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->getUserById($id);
        if (!$user) {
            return null; // User not found
        }
        
        return $this->userDao->update($id, $data);
    }

    public function getAllUsers()
    {
        return $this->userDao->all();
    }

    public function deleteUser(int $id)
    {
        return $this->userDao->delete($id);
    }
}