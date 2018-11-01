<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Staff(['userName'=>'Manager1','fullName'=>'Manager Natalia','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Manager2','fullName'=>'Manager Jenifer','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Tester1','fullName'=>'Tester Ami','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Tester2','fullName'=>'Tester Bill','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Tester3','fullName'=>'Tester Cris','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Tester4','fullName'=>'Tester Dion','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Tester5','fullName'=>'Tester Elle','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Developer1','fullName'=>'Developer Lei','password'=>'123456','title'=>'developer']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Developer2','fullName'=>'Developer Billy','password'=>'123456','title'=>'developer']);
        $varible->save();
        $varible=new \App\Staff(['userName'=>'Developer3','fullName'=>'Developer Cool','password'=>'123456','title'=>'developer']);
        $varible->save();

    }
}
