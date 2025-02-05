<?php

namespace App\Http\Controllers;

use App\Models\Swimmingpool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class SwimmingPoolController extends Controller
{
      // Menampilkan daftar kolam renang
      public function index() : View
      {
          $swimmingPools = SwimmingPool::all(); // Ambil semua kolam renang dari database
          return view('swimmingPools.index', compact('swimmingPools'));
      }
  
    
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
        $image = $request->file('image');
        if ($image) {$imagePath = $image->storeAs('public/swimmmingPools', $image->hashName());}


        // Create the swimming pool entry
        SwimmingPool::create([
            'user_id'          => Auth::id(),
            'image'            => isset($imagePath) ? $request->file('mage')->hashName() : null,
            'name'             => $request->name,
            'description'      => $request->description,
            'location'         => $request->location,
            'price_per_person' => $request->price_per_person,
        ]);

        return redirect()->route('swimmingPools.index')->with('success', 'Swimming pool created successfully!');
    }

    // Menampilkan detail kolam renang
    public function show(String $id) : View
    {
        $swimmingPools = SwimmingPool::findorFall($id);
        return view('swimmingPools.show', compact('swimmingPool'));
    }
}
