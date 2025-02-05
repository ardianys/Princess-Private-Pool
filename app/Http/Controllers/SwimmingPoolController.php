<?php

namespace App\Http\Controllers;

use App\Models\SwimmingPool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class SwimmingPoolController extends Controller
{
    
    public function create() : View
    {
        return view('swimmingPools.create');
    }

    // Menyimpan data booking
    public function store(Request $request) : RedirectResponse
{
    $request->validate([
        'image'            => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'name'             => 'required|string',
        'description'      => 'nullable|string',
        'location'         => 'nullable|string',
        'price_per_person' => 'nullable|numeric',
    ]);

    // Pastikan pengguna sudah login
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors('Please login to create a swimmingpool.');
    }

    //upload image
    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->storeAs('public/swimmingPool', $image->hashName());
    }

    // Create the swimming pool entry
    $swimmingPool = SwimmingPool::create([
        'user_id'          => Auth::id(),
        'image'            => $imagePath,
        'name'             => $request->name,
        'description'      => $request->description,
        'location'         => $request->location,
        'price_per_person' => $request->price_per_person,
    ]);

    return redirect()->route('swimmingPools.index')->with('success', 'Swimming pool created successfully!');
}

    // Menampilkan daftar kolam renang
    public function index() : View
    {
        $swimmingPools = SwimmingPool::all(); // Ambil semua kolam renang dari database
        return view('swimmingPools.index', compact('swimmingPools'));
    }

    // Menampilkan detail kolam renang
    public function show(SwimmingPool $swimmingPool)
    {
        return view('swimmingPools.show', compact('swimmingPool'));
    }
}
