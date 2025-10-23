<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confection;

class ConfectionController extends Controller
{
    public function index()
    {

        
        $confections = Confection::with(['contents', 'prices'])->get();
        return view('confections.index', compact('confections'));
    }
}
