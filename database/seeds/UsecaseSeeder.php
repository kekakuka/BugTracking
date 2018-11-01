<?php

use Illuminate\Database\Seeder;

class UsecaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Usecase(['name'=>'Register','subsystem_id'=>1,'description'=>'The visitor can register.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Home Page','subsystem_id'=>2,'description'=>'The user can browse the home page.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Place Order','subsystem_id'=>3,'description'=>'The user can place order.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Change Account Detials','subsystem_id'=>4,'description'=>'The user can change their account details.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Create Souvenirs','subsystem_id'=>5,'description'=>'The admin can create the new souvenir.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Disable the customer','subsystem_id'=>6,'description'=>'The admin can disable the customer.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Ship the Order','subsystem_id'=>7,'description'=>'The admin can ship the order.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Calculate Mortgage','subsystem_id'=>8,'description'=>'User can Calculate Mortgage online.']);
        $varible->save();
        $varible=new \App\Usecase(['name'=>'Create House Model','subsystem_id'=>9,'description'=>'User can create house model on the page.']);
        $varible->save();
    }
}
