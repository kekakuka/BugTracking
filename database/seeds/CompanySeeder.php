<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Company(['id'=>1,'description'=>'Team 1 has a finished project','companyName'=>'Team1']);
        $varible->save();
        $varible=new \App\Company(['id'=>2,'description'=>'Team 1 has a testing project','companyName'=>'Team2']);
        $varible->save();
    }
}
