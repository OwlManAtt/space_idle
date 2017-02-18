<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Functionality to manage a static lookup table's seed data.
 *
 * @TODO: delete the whole thing, <https://laravel.com/docs/5.4/eloquent#other-creation-methods>
 */
abstract class LookupSeeder extends Seeder
{

    protected function seedLookup($table, $seeds)
    {
        foreach ($seeds as $id => $seed) {
            $this->updateOrInsert($table, $id, $seed);
        }

        return null;
    } // end seedLookup

    /**
     * Insert or update an existing row in a lookup table.
     *
     * @param integer PK for `id` column
     * @param array Hash of col->value. `id` will be added for inserts if it is not present.
     * @return bool
     */
    protected function updateOrInsert($table, $id, $row)
    {
        $query = DB::table($table);

        $exists = DB::table($table)->where('id', '=', $id)->first();
        if ($exists == null) {
            $row['id'] = $id;
            return $query->insert($row);
        }

        return $query->where('id', '=', $id)->update($row);
    } // end updateOrInsert
} // end LookupSeeder
