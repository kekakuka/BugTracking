<?php

use Illuminate\Database\Seeder;

class TestcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Testcase(['name'=>'Register with invalid email address','usecase_id'=>1,'description'=>'Using "abd" register the website as a email address.']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Link home page','usecase_id'=>2,'description'=>'Link to the home page by clicking the Logo.']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Place order','usecase_id'=>3,'description'=>'Place an order by click check out.']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Change user address','usecase_id'=>4,'description'=>'Change the test customer\'s address to "my address".']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Create souvenir with invalid name','usecase_id'=>5,'description'=>'Change the test customer\'s address to "my address".']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Disable customer','usecase_id'=>6,'description'=>'Disable the customer by clicking the disable button.']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Ship order','usecase_id'=>7,'description'=>'Ship test customers order by clicking the ship button.']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Calculation Layout','usecase_id'=>8,'description'=>'Open the URL of the mortgage calculation page.']);
        $varible->save();
        $varible=new \App\Testcase(['name'=>'Create New Model','usecase_id'=>9,'description'=>'Create new house model by clicking the new button on the page.']);
        $varible->save();
    }
}
