<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $this->createDumyAgen();
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

    private function createDumyAgen()
    {
        // dumy data agen
        collect([
            [
                'name' => 'Annis Balqisa',
                'email' => '202410101045@thempe.id',
                'nohp' => '202410101045',
                'alamat' => '-8.167493, 113.713525',
                'password' => '202410101045'
            ],
            [
                'name' => 'M. Nasrul Wahabi',
                'email' => '202410101052@thempe.id',
                'nohp' => '202410101052',
                'alamat' => '-8.167493, 113.713525',
                'password' => '202410101052'
            ],
            [
                'name' => 'Adhitya Hari Saputra',
                'email' => '202410101103@thempe.id',
                'nohp' => '202410101103',
                'alamat' => '-8.167493, 113.713525',
                'password' => '202410101103'
            ],
            [
                'name' => 'Jazzy Arminta Irmadella',
                'email' => '202410101113@thempe.id',
                'nohp' => '202410101113',
                'alamat' => '-8.167493, 113.713525',
                'password' => '202410101113'
            ],
            [
                'name' => 'Dewana Kretarta Lokeswara',
                'email' => '202410101137@thempe.id',
                'nohp' => '202410101137',
                'alamat' => '-8.167493, 113.713525',
                'password' => '202410101137'
            ],
        ])->each(function ($data) {
            User::create($data)->assignRole('agen');
        });
    }

    private function createOwner()
    {
        // insert owner
        User::create([
            'name' => 'Andriyanto',
            'email' => 'andriyanto@owner.com',
            'nohp' => '085432149322',
            'alamat' => '-8.167493, 113.713525',
            'email_verified_at' => now(),
            'password' => 'andriyantoowner',
        ])->assignRole('owner');
    }
}
