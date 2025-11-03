<?php

namespace App\Http\Controllers;

use App\Models\Confection;
use Illuminate\Http\Request;

class ConfectionCrudController extends Controller
{
    public function index()
    {
        $confections = Confection::orderBy('id', 'asc')->get();
        return view('confections.manage.index', compact('confections'));
    }

    public function create()
    {
        return view('confections.manage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cname' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        Confection::create([
            'cname' => $request->cname,
            'type' => $request->type,
            'prizewinning' => $request->has('prizewinning'),
        ]);

        return redirect()->route('confections_manage.index')->with('status', 'Confection created!');
    }

    public function edit(Confection $confections_manage)
    {
        return view('confections.manage.edit', ['confection' => $confections_manage]);
    }

    public function update(Request $request, Confection $confections_manage)
    {
        $request->validate([
            'cname' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $confections_manage->update([
            'cname' => $request->cname,
            'type' => $request->type,
            'prizewinning' => $request->has('prizewinning'),
        ]);

        return redirect()->route('confections_manage.index')->with('status', 'Confection updated!');
    }

    public function destroy(Confection $confections_manage)
    {
        $confections_manage->delete();
        return redirect()->route('confections_manage.index')->with('status', 'Confection deleted!');
    }
}
