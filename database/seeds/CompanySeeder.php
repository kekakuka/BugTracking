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
        $varible=new \App\Company(['id'=>1,'description'=>'Team Example is used to show the report','companyName'=>'Team Example']);
        $varible->save();
        $varible=new \App\Company(['id'=>2,'description'=>'Team 1 is a new team ','companyName'=>'Team1']);
        $varible->save();
        $varible=new \App\Company(['id'=>3,'description'=>'Team 2 is a new team ','companyName'=>'Team2']);
        $varible->save();
        $varible=new \App\Company(['id'=>4,'description'=>'Team 3 is a new team ','companyName'=>'Team3']);
        $varible->save();
        $varible=new \App\Company(['id'=>5,'description'=>'Team 4 is a new team ','companyName'=>'Team4']);
        $varible->save();
        $varible=new \App\Company(['id'=>6,'description'=>'Team 5 is a new team ','companyName'=>'Team5']);
        $varible->save();
    }
}
