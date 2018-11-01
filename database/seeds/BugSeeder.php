<?php

use Illuminate\Database\Seeder;

class BugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Bug(['severity'=>1,'priority'=>2,'test_id'=>1,'description'=>'The email address "abc" can be registered as a valid email address.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>4,'priority'=>3,'test_id'=>2,'description'=>'The logo cannot link to the home page.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>4,'priority'=>5,'test_id'=>3,'description'=>'The order detail cannot be shown correctly.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>5,'priority'=>5,'test_id'=>4,'description'=>'The amount of the order missing.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>3,'priority'=>3,'test_id'=>5,'description'=>'The "" souvenir name can be created.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>2,'priority'=>1,'test_id'=>6,'description'=>'The disabled user can login the website.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>3,'priority'=>3,'test_id'=>7,'description'=>'Find a bug.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>5,'priority'=>5,'test_id'=>8,'description'=>'The Amount text area is to short.']);
        $varible->save();
        $varible=new \App\Bug(['severity'=>1,'priority'=>1,'test_id'=>9,'description'=>'The create new button does not work.']);
        $varible->save();
    }
}
