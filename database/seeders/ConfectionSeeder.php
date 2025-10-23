<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed confections
        $confectionLines = file(storage_path('app/confections.txt'), FILE_IGNORE_NEW_LINES);
         foreach (array_slice($confectionLines, 1) as $line) {
            [$cname, $type, $prizewinning] = explode("\t", $line);
             \App\Models\Confection::create([
                 'cname' => $cname,
                 'type' => $type,
                  'prizewinning' => $prizewinning === 'true',
                    ]);
                    }

        // Seed contents
        $contentLines = file(storage_path('app/contents.txt'), FILE_IGNORE_NEW_LINES);
            foreach (array_slice($contentLines, 1) as $line) {
                [$confid, $free] = explode("\t", $line);
                \App\Models\Content::create([
                    'confid' => $confid,
                    'free' => $free,
                    ]);
                    }

        // Seed prices
        $priceLines = file(storage_path('app/prices.txt'), FILE_IGNORE_NEW_LINES);
            foreach (array_slice($priceLines, 1) as $line) {
                [$confid, $price, $unit] = explode("\t", $line);
                \App\Models\Price::create([
                    'confid' => $confid,
                    'price' => (int) $price,
                    'unit' => $unit,
                    ]);
                    }
    }
}
