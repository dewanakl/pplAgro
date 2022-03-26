<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createRole();
        $this->createAdmin();
    }

    private function createRole()
    {
        // create role
        collect(['admin', 'user'])->each(function ($name) {
            Role::create([
                'name' => $name
            ]);
        });
    }

    private function createAdmin()
    {
        // insert admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminadmin'),
        ])->assignRole('admin');
    }
}
