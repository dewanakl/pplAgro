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
        $this->createOwner();
    }

    private function createRole()
    {
        // create role
        collect(['owner', 'agen'])->each(function ($name) {
            Role::create([
                'name' => $name
            ]);
        });
    }

    private function createOwner()
    {
        // insert owner
        User::create([
            'name' => 'Andriyanto',
            'email' => 'andriyanto@owner.com',
            'email_verified_at' => now(),
            'password' => 'andriyantoowner',
        ])->assignRole('owner');
    }
}
