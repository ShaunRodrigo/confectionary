<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Confection;

class ChartController extends Controller
{
    /**
     * Return JSON data for Chart.js
     */
    public function data(Request $request)
    {
        // Try to aggregate number of confections per type.
        // If the database is not available (or the Confection model/table is missing),
        // return a well-formed empty JSON payload so the frontend can handle it gracefully.
        try {
            $rows = Confection::select('type', DB::raw('count(*) as total'))
                ->groupBy('type')
                ->get();

            $labels = $rows->pluck('type')->map(fn($t) => $t ?? 'Unknown')->toArray();
            $data = $rows->pluck('total')->toArray();

            // If the query returns nothing, provide a small demo dataset so the UI
            // always has something to render for visual verification.
            if (empty($labels) || empty($data)) {
                $demoLabels = ['Chocolates', 'Candies', 'Pastries', 'Cookies'];
                $demoData = [12, 8, 5, 3];

                return response()->json([
                    'labels' => $demoLabels,
                    'data' => $demoData,
                    'empty' => false,
                    'demo' => true,
                ]);
            }

            return response()->json([
                'labels' => $labels,
                'data' => $data,
                'empty' => false,
            ]);
        } catch (\Throwable $e) {
            // Log the error server-side (optional) and return an empty dataset plus an error message.
            // Using logger() here keeps it simple and avoids requiring additional facades.
            if (function_exists('logger')) {
                logger('ChartController:data error: ' . $e->getMessage());
            }

            // On exception (DB down etc) return a demo dataset so the frontend
            // still shows a useful example chart.
            $demoLabels = ['Chocolates', 'Candies', 'Pastries', 'Cookies'];
            $demoData = [12, 8, 5, 3];

            return response()->json([
                'labels' => $demoLabels,
                'data' => $demoData,
                'empty' => false,
                'demo' => true,
                'error' => true,
                'message' => 'Data unavailable, showing example chart',
            ]);
        }
    }
}
