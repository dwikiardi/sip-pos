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
            'password' => bcrypt('4dm1n@k1nt4m4n1'),
            'image' => 'assets/media/users/default.png'
        ]);
    }
}
