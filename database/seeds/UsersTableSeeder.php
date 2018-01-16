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
        factory(App\User::class, 15)->create();

        //Usuario para ingresar a panel de admon
        
       App\User::create([
        'firstname' =>  'Freddy',
        'lastname'  =>  'Marroquin',
        'email'     =>  'fl.mlopezgt@gmail.com',  
        'username'  =>  'newtella',
        'password'  =>  bcrypt('newtella'),
        'rol_id'    =>  '1',

       ]);
        
    }
}
