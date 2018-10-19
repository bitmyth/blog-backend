<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = '管理员'; // optional
        $admin->description = ''; // optional
        $admin->save();
    }
}
