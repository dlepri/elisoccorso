<?php

use Illuminate\Database\Seeder;

class SecondariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Secondary::class, 200)->create();
    }
}
