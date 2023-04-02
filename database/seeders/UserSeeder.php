<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Admin')->first();
        User::create([
            'role_id' => $role->id,
            'username' => 'admin',
            'password' => bcrypt('admin1234'),
            'image' => 'assets/media/users/default.png'
        ]);
    }
}
