<?php

namespace App\Http\Controllers;

use App\Models\Allotment;
use App\Models\Swimmingpool;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allotments = Allotment::with('swimmingpool')->latest()->get();

        return view('allotments.index', compact('allotments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $swimmingpools = Swimmingpool::all();

        return view('allotments.create', compact('swimmingpools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'swimmingpool_id'   => 'required|exists:swimmingpools,id',
        'date'              => 'required|date',
        'open'              => 'required',
        'closed'            => 'required',
        'session'           => 'required|integer',
        'price_per_person'  => 'required|numeric|min:0',
        'total_person'      => 'required|integer|min:1',
        ]);

        Allotment::create([
            'swimmingpool_id'   => $request->swimmingpool_id,
            // 'slug'              => Str::slug($request->swimmingpool_id . '-' . $request->date . '-' . time()),
            'date'              => $request->date,
            'open'              => $request->open,
            'closed'            => $request->closed,
            'session'           => $request->session,
            'price_per_person'  => $request->price_per_person,
            'total_person'      => $request->total_person,
        ]);

        return redirect()->route('allotments.index')->with('success', 'Allotment successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Allotment $allotment)
    {
        return view('allotments.show', compact('allotment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allotment $allotment)
    {
        $swimmingpools = Swimmingpool::all();

        return view('allotments.edit', compact('allotment', 'swimmingpools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Allotment $allotment)
    {
        $request->validate([
            'swimmingpool_id'   => 'required|exists:swimmingpools,id',
            'date'              => 'required|date',
            'open'              => 'required',
            'closed'            => 'required',
            'session'           => 'required|integer',
            'price_per_person'  => 'required|numeric|min:0',
            'total_person'      => 'required|integer|min:1',
        ]);

        $allotment->update($request->all());

        return redirect()->route('swimmingpools.show',$allotment->swimmingpool_id)->with('success', 'Allotment successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allotment $allotment)
    {
        $allotment->delete();

        return redirect()->route('allotments.index')->with('success', 'Allotment, delete success!');
    }
}
