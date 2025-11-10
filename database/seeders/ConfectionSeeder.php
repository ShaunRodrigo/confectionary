<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Confection;
use App\Models\Content;
use App\Models\Price;

class ConfectionSeeder extends Seeder
{
    public function run(): void
    {
        // helper to read a file safely
        $readFile = function($path) {
            $full = storage_path('app/' . $path);
            if (!file_exists($full)) return [];
            return file($full, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        };

        // --- Confections ---
        $confectionLines = $readFile('confections.txt');
        $rows = [];
        foreach (array_slice($confectionLines, 1) as $line) {
            $parts = preg_split('/\s+/', trim($line), -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) < 4) continue;
            $id = (int) array_shift($parts);
            $prizewinning = array_pop($parts);
            $type = implode(' ', array_slice($parts, -2, 2));
            $cname = implode(' ', array_slice($parts, 0, count($parts) - 2));
            $rows[] = [
                // optional: keep id if present
                'id' => $id,
                'cname' => $cname,
                'type' => $type,
                'prizewinning' => $prizewinning === '1' || strtolower($prizewinning) === 'true',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($rows)) {
            // insert ignoring duplicates (idempotent)
            DB::table('confections')->insertOrIgnore($rows);
        }

        // --- Contents ---
        $contentLines = $readFile('contents.txt');
        $rows = [];
        foreach (array_slice($contentLines, 1) as $line) {
            $parts = preg_split('/\s+/', trim($line), -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) < 3) continue;
            $id = (int)$parts[0];
            $confid = (int)$parts[1];
            $free = $parts[2];
            // ensure confection exists (by id or by other key)
            if (!DB::table('confections')->where('id', $confid)->exists()) continue;
            $rows[] = [
                'id' => $id,
                'confid' => $confid,
                'free' => $free,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($rows)) {
            DB::table('contents')->insertOrIgnore($rows);
        }

        // --- Prices ---
        $priceLines = $readFile('prices.txt');
        $rows = [];
        foreach (array_slice($priceLines, 1) as $line) {
            $parts = preg_split('/\s+/', trim($line), -1, PREG_SPLIT_NO_EMPTY);
            if (count($parts) < 4) continue;
            $id = (int)$parts[0];
            $confid = (int)$parts[1];
            $price = $parts[2];
            $unit = $parts[3];
            if (!DB::table('confections')->where('id', $confid)->exists()) continue;
            $rows[] = [
                'id' => $id,
                'confid' => $confid,
                'price' => $price,
                'unit' => $unit,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($rows)) {
            DB::table('prices')->insertOrIgnore($rows);
        }

        // --- Advance sequences (Postgres) OR set AUTO_INCREMENT (MySQL) ---
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement("SELECT setval(pg_get_serial_sequence('confections','id'), (SELECT COALESCE(MAX(id),0) FROM confections));");
            DB::statement("SELECT setval(pg_get_serial_sequence('contents','id'), (SELECT COALESCE(MAX(id),0) FROM contents));");
            DB::statement("SELECT setval(pg_get_serial_sequence('prices','id'),   (SELECT COALESCE(MAX(id),0) FROM prices));");
        } else {
            $maxCon = (int) DB::table('confections')->max('id') ?: 0;
            $maxCnt = (int) DB::table('contents')->max('id') ?: 0;
            $maxPri = (int) DB::table('prices')->max('id') ?: 0;
            DB::statement("ALTER TABLE confections AUTO_INCREMENT = " . ($maxCon + 1));
            DB::statement("ALTER TABLE contents   AUTO_INCREMENT = " . ($maxCnt + 1));
            DB::statement("ALTER TABLE prices     AUTO_INCREMENT = " . ($maxPri + 1));
        }
    }
}