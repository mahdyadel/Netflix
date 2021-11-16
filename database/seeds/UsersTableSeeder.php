<?php

use App\User;
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
        $user = User::create([
            
            'name' => 'super_admin',            
            'email' => 'super_admin@gmail.com',
            'password'=> bcrypt('123123'),

            ]);

            $user->attachRole('super_admin');

    }//en dof run 

}//end of seeder
