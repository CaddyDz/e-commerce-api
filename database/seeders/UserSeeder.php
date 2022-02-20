<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Sudo',
            'email' => 'admin@buckhill.co.uk',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);
        User::factory(10)->create();
    }
}
