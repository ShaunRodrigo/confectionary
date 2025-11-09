<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Confection;
use App\Models\Content;
use App\Models\Price;

class ConfectionSeeder extends Seeder
{
    public function run(): void
    {
        // Seed confections
        $confectionLines = file(storage_path('app/confections.txt'), FILE_IGNORE_NEW_LINES);
        foreach (array_slice($confectionLines, 1) as $line) {
            $parts = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) < 4) continue;

            $id = $parts[0];
            $prizewinning = array_pop($parts);
            $type = implode(' ', array_slice($parts, -2, 2));
            $cname = implode(' ', array_slice($parts, 1, count($parts) - 3));

            Confection::create([
                'id' => (int) $id,
                'cname' => $cname,
                'type' => $type,
                'prizewinning' => (bool) $prizewinning,
            ]);
        }

        // Seed contents
        $contentLines = file(storage_path('app/contents.txt'), FILE_IGNORE_NEW_LINES);
        foreach (array_slice($contentLines, 1) as $line) {
            $parts = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) < 3) continue;

            [$id, $confid, $free] = $parts;
            if (!Confection::find((int) $confid)) continue;

            Content::create([
                'id' => (int) $id,
                'confid' => (int) $confid,
                'free' => $free,
            ]);
        }

        // Seed prices
        $priceLines = file(storage_path('app/prices.txt'), FILE_IGNORE_NEW_LINES);
        foreach (array_slice($priceLines, 1) as $line) {
            $parts = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) < 4) continue;

            [$id, $confid, $price, $unit] = $parts;
            if (!Confection::find((int) $confid)) continue;

            Price::create([
                'id' => (int) $id,
                'confid' => (int) $confid,
                'price' => (int) $price,
                'unit' => $unit,
            ]);
        }
    }
}
