<?php

use Database\Seeds\LookupSeeder;

class ResourceTypeSeeder extends LookupSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resource_types = [
            1 => [
                'short_code' => 'ore',
                'name' => 'Common Ore',
                'icon' => 'icon.png',
                'description' => 'An assortment of raw ore harvested from asteroids, dust clouds, rings, and space trash. You can use process the ore to fabricate advanced materials for construction.',
                'base_harvest_interval' => 900,
                'base_harvest_amount' => 25,
                'basic' => true,
            ],
            2 => [
                'short_code' => 'nutrition',
                'name' => 'Nutrition',
                'icon' => 'icon.png',
                'description' => 'A combination of synthetic protein and nutrients harvested from algea. You need this to feed the staff.',
                'base_harvest_interval' => 900,
                'base_harvest_amount' => 5,
                'basic' => true,
            ],
            3 => [
                'short_code' => 'energy',
                'name' => 'Energy',
                'icon' => 'icon.png',
                'description' => 'Energy stored in chemical batteries by your fleet of solar collectors.',
                'base_harvest_interval' => 900,
                'base_harvest_amount' => 5,
                'basic' => true,
            ],
            4 => [
                'short_code' => 'maps',
                'name' => 'Astrocartography Data',
                'icon' => 'icon.png',
                'description' => 'Reports from survey drones on the locations, compositions, and conditions of all manner of celestial objects.',
                'base_harvest_interval' => 1800,
                'base_harvest_amount' => 1,
                'basic' => true,
            ],
        ];
        
        return $this->seedLookup('resource_types', $resource_types);
    } // end run
}
