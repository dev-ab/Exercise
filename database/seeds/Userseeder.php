<?php

use Illuminate\Database\Seeder;

class Userseeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        App\Group::create(['name' => 'user']);
        App\Group::create(['name' => 'moderator']);
        App\Permission::create(['name' => 'view_users']);
        App\Permission::create(['name' => 'delete_users']);
        App\Permission::create(['name' => 'view_profile']);
        App\Permission::create(['name' => 'edit_profile']);

        App\Permission::all()->each(function($p) {
            \App\Group::all()->each(function($g) use ($p) {
                $g->permissions()->save($p);
            });
        });

        factory(App\User::class, 10)->create()->each(function($u) {
            $u->info()->save(factory(App\Info::class)->make());
        });
        factory(App\User::class, 'admin', 3)->create()->each(function($u) {
            $u->info()->save(factory(App\Info::class)->make());
        });
    }

}
