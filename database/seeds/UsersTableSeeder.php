<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->times(10)->create();

        $user=\App\Models\User::find(1);
        $user->update([
            'name'=>'tommy',
            'email'=>'tommy@example.com',
            'password'=>bcrypt('st123456'),
            'avatar'=>'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'introduction'=>'第一位用户',
        ]);
    }
}
