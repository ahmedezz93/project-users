<?php

namespace Database\Seeders;

use App\Models\type_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class type_userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    DB::table('type_users')->delete();

    $types=[

        ["id"=>1,"name"=>"first type"],
        ["id"=>2,"name"=>"second type"],
        ["id"=>3,"name"=>"third type"],

 ];



 foreach($types as $type){

type_user::create($type);

 }



    }
}
