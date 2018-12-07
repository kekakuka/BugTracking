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

        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Manager1','fullName'=>'Manager Natalia','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Manager2','fullName'=>'Manager Jenifer','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Tester1','fullName'=>'Tester Ami','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Tester2','fullName'=>'Tester Bill','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Tester3','fullName'=>'Tester Cris','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Tester4','fullName'=>'Tester Dion','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Tester5','fullName'=>'Tester Elle','password'=>'123456','title'=>'tester']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Developer1','fullName'=>'Developer Lei','password'=>'123456','title'=>'developer']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Developer2','fullName'=>'Developer Billy','password'=>'123456','title'=>'developer']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>1,'userName'=>'Developer3','fullName'=>'Developer Cool','password'=>'123456','title'=>'developer']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>2,'userName'=>'T1M1','fullName'=>'Team1 Manager1','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>3,'userName'=>'T2M1','fullName'=>'Team2 Manager1','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>4,'userName'=>'T3M1','fullName'=>'Team3 Manager1','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>5,'userName'=>'T4M1','fullName'=>'Team4 Manager1','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>6,'userName'=>'T5M1','fullName'=>'Team5 Manager1','password'=>'123456','title'=>'manager']);
        $varible->save();
        $varible=new \App\Staff(['company_id'=>null,'userName'=>'Admin','fullName'=>'Administrator Natalia','password'=>'123456','title'=>'admin']);
        $varible->save();
    }
}
