<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varible=new \App\Setting(['description'=>'Window10, Chrome Browser.']);
        $varible->save();
        $varible=new \App\Setting(['description'=>'Window10, FireFox Browser.']);
        $varible->save();
        $varible=new \App\Setting(['description'=>'IOS, Safari']);
        $varible->save();
        $varible=new \App\Setting(['description'=>'Android,Chrome Browser']);
        $varible->save();

    }
}
