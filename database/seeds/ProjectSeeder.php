<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Project(['company_id'=>1,'name'=>'Quality Souvenir Website','description'=>'Quality souvenir company sells souvenirs on the website application.']);
        $varible->save();
        $varible=new \App\Project(['company_id'=>1,'name'=>'House website application','description'=>'This website application is selling a pre-build houses online.']);
        $varible->save();

    }
}
