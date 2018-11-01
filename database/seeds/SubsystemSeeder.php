<?php

use Illuminate\Database\Seeder;

class SubsystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Subsystem(['name'=>'Login','project_id'=>1,'description'=>'Contains the Register and Login Pages.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Main Page','project_id'=>1,'description'=>'Home Page and Navigation.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Purchase Page','project_id'=>1,'description'=>'Purchase Page displays the souvenirs，add to cart and place an order.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Account Page','project_id'=>1,'description'=>'The user can manage their Account.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Souvenir Management','project_id'=>1,'description'=>'The administrator can manage the souvenirs.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Customer Management','project_id'=>1,'description'=>'The administrator can manage customers account.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Order Management','project_id'=>1,'description'=>'The administrator can manage the orders.']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'Mortgage Calculation','project_id'=>2,'description'=>'Mortgage calculation page – to help potential clients make easy estimation..']);
        $varible->save();
        $varible=new \App\Subsystem(['name'=>'House online design','project_id'=>2,'description'=>'User able to do online design for his/her house from pre-existing modules. This form allows users to model his/her desired house and evaluate cost with current price for a building modules and estimate cost for variety.']);
        $varible->save();
    }
}
