<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([ 
            'area_new'=>'admin'
                    ]);
            
        DB::table('users')->insert([ 
            'email'=>'sistema@gmail.com',
            'password'=>bcrypt('password'),
            'id_area'=>1,
            'email_verified_at' => now(),
            ]);
            
        DB::table('datos_users')->insert([ 
                'nombre'=>'sistema dev',
                 'id_user'=>1
        ]);


    }
}
