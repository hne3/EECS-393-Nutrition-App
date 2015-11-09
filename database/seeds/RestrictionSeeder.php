<?php

use Illuminate\Database\Seeder;

class RestrictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r = new \App\Restriction();
        $r->display_name = "Nut Allergy";
        $r->save();

        $r = new \App\Restriction();
        $r->display_name = "Seafood Allergy";
        $r->save();

        $r = new \App\Restriction();
        $r->display_name = "Dairy Allergy";
        $r->save();

        $r = new \App\Restriction();
        $r->display_name = "Lactose Intolerance";
        $r->save();

        $r = new \App\Restriction();
        $r->display_name = "Chocolate Allergy";
        $r->save();

    }
}
