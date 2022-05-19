<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $this->createDummyAgen();
    }

    private function createRole()
    {
        // create role
        collect(['owner', 'agen'])->each(function ($name) {
            Role::create([
                'name' => $name
            ]);
            DB::table('role')->insert([
                'namaRole' => $name
            ]);
        });
    }

    private function createOwner()
    {
        // insert owner
        User::create([
            'idRole' => 1,
            'name' => 'Andriyanto',
            'email' => 'andriyanto@owner.com',
            'nohp' => '085432149322',
            'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
            'password' => 'andriyantoowner',
        ])->assignRole('owner');

        // alamat pabrik 
        DB::table('pabriks')->insert([
            'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121'
        ]);

        // produk
        DB::table('produk')->insert([
            'nama' => 'thempe',
            'harga' => 15000
        ]);

        // bahan baku
        collect([
            [
                'namaBahanBaku' => 'Kedelai',
                'jumlahStok' => 7000,
                'sisaStok' => 7000
            ],
            [
                'namaBahanBaku' => 'Ragi',
                'jumlahStok' => 300,
                'sisaStok' => 300
            ],
            [
                'namaBahanBaku' => 'Plastik',
                'jumlahStok' => 100,
                'sisaStok' => 100
            ],
        ])->each(function ($data) {
            DB::table('bahan_baku')->insert($data);
        });
    }

    private function createDummyAgen()
    {
        // dummy data agen
        collect([
            [
                'idRole' => 2,
                'name' => 'Annis Balqisa',
                'email' => '202410101045@thempe.id',
                'nohp' => '202410101045',
                'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'password' => '202410101045'
            ],
            [
                'idRole' => 2,
                'name' => 'M. Nasrul Wahabi',
                'email' => '202410101052@thempe.id',
                'nohp' => '202410101052',
                'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'password' => '202410101052'
            ],
            [
                'idRole' => 2,
                'name' => 'Adhitya Hari Saputra',
                'email' => '202410101103@thempe.id',
                'nohp' => '202410101103',
                'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'password' => '202410101103'
            ],
            [
                'idRole' => 2,
                'name' => 'Jazzy Arminta Irmadella',
                'email' => '202410101113@thempe.id',
                'nohp' => '202410101113',
                'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'password' => '202410101113'
            ],
            [
                'idRole' => 2,
                'name' => 'Dewana Kretarta Lokeswara',
                'email' => '202410101137@thempe.id',
                'nohp' => '202410101137',
                'alamat' => 'Jl. Kalimantan Tegalboto No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'password' => '202410101137'
            ],
        ])->each(function ($data) {
            User::create($data)->assignRole('agen');
        });
    }
}
