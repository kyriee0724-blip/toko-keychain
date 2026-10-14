<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Schema;
use App\Models\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Login Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('sekar123'),
        ]);

        // 2. Data Skema Awal
        $schema1 = Schema::create([
            'code'        => 'SKM-01',
            'name'        => 'Junior developer',
            'description' => 'SKM 01 Junior developer.',
        ]);

        $schema2 = Schema::create([
            'code'        => 'SKM-BSK',
            'name'        => 'Keychain Boneka Mini',
            'description' => 'Gantungan kunci kain boneka halus.',
        ]);

        // 3. Tambahkan Peserta Baru
        Participant::create([
            'schema_id' => $schema1->id,
            'name'      => 'Haura',
            'email'     => 'haura@gmail.com',
            'phone'     => '081234567801',
            'address'   => 'Jl. Huleng celeng meleng No. 1',
        ]);

        Participant::create([
            'schema_id' => $schema1->id,
            'name'      => 'Cia',
            'email'     => 'cia@gmail.com',
            'phone'     => '081234567802',
            'address'   => 'Jl. Gendiss No. 2',
        ]);

        Participant::create([
            'schema_id' => $schema2->id,
            'name'      => 'Sayyidah',
            'email'     => 'sayyidah@gmail.com',
            'phone'     => '081234567803',
            'address'   => 'Jl. Sayyidupp No. 3',
        ]);

        Participant::create([
            'schema_id' => $schema2->id,
            'name'      => 'Mutiara',
            'email'     => 'mutiara@gmail.com',
            'phone'     => '081234567804',
            'address'   => 'Jl. Budeh budeh No. 4',
        ]);
    }
}