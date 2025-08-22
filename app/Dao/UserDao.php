<?php 

namespace App\Dao;

use App\Models\User;

class UserDao
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function update(int $id, array $data): ?User
    {
        return User::where('id', $id)->update($data);;
    }

    public function all()
    {
        return User::all();
    }

    public function delete(int $id): bool
    {
        return User::destroy($id);
    }

}