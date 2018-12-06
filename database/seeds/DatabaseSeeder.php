<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(SubsystemSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(UsecaseSeeder::class);
        $this->call(TestcaseSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(BugSeeder::class);
        $this->call(BugassignSeeder::class);
    }
}
