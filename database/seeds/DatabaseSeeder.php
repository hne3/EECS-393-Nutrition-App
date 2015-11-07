<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FoodDataSeeder::class);
        $this->call(CaffeineDataSeeder::class);
        $this->call(CalciumDataSeeder::class);
        $this->call(CarbohydrateDataSeeder::class);
        $this->call(CopperDataSeeder::class);
        $this->call(FatDataSeeder::class);
        $this->call(FiberDataSeeder::class);
        $this->call(IronDataSeeder::class);
        $this->call(MagnesiumDataSeeder::class);
        $this->call(ManganeseDataSeeder::class);
        $this->call(PhosphorusDataSeeder::class);
        $this->call(PotassiumDataSeeder::class);
        $this->call(ProteinDataSeeder::class);
        $this->call(SodiumDataSeeder::class);
        $this->call(SugarDataSeeder::class);
        $this->call(VitaminADataSeeder::class);
        $this->call(VitaminB12DataSeeder::class);
        $this->call(VitaminB6DataSeeder::class);
        $this->call(VitaminCDataSeeder::class);
        $this->call(VitaminDDataSeeder::class);
        $this->call(VitaminEDataSeeder::class);
        $this->call(VitaminKDataSeeder::class);
        $this->call(ZincDataSeeder::class);
        $this->call(AgeRangeDataSeeder::class);
        $this->call(DailyValueSeeder::class);
        $this->call(AgeRangeDataSeeder::class);
    }
}
