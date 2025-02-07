<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function create(array $data): User
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'how_you_want_to_use' => $data['how_you_want_to_use'],
            'country' => $data['country'],
            'currency' => $data['currency'],
            'phone' => $data['phone'],
            'avatar' => $data['avatar'] ?? null,
            'referal_username' => $data['referal_username'] ?? null,
            'referal_code' => $data['referal_code'] ?? null,
        ]);
    }
}
