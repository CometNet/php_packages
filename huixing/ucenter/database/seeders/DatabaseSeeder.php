<?php
namespace Huixing\UCenter\Database\Seeders;

use Illuminate\Database\Seeder;
use Huixing\UCenter\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        User::truncate();
        User::create([
            'email' => 'admin@qq.com',
            'password' => bcrypt('admin'),
            'name'     => 'admin',
            'username' => 'admin'
        ]);
    }

}