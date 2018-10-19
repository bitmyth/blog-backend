<?php

use App\Models\Role;
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
        $admin = new \App\User([
            'name' => 'adminDemo',
            'email' => 'admin@163.com',
            'phone' => '13470079150',
            'password' => bcrypt('123'),
        ]);
        $admin->save();

        $admin->attachRole(Role::find(1));

        factory(App\User::class, 12)->create()->each(function ($u) {
//            $u->posts()->save(factory(Post::class)->make());
        });
    }
}
