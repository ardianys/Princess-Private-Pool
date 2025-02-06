<?php

namespace App\Http\Controllers;

use App\Models\Swimmingpool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class SwimmingpoolController extends Controller
{
      // Menampilkan daftar kolam renang
      public function index() : View
      {
          $swimmingpools = Swimmingpool::all(); // Ambil semua kolam renang dari database
          return view('swimmingpools.index', compact('swimmingpools'));
      }
  
    
    public function create() : View
    {
        return view('swimmingpools.create');
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
        $imageName=$image->hashName();
        $request->image->move(public_path('swimmmingpools'), $imageName);
        // if ($image) {$imagePath = $image->storePubliclyAs('swimmmingpools', $image->hashName(),'s3');}


        // Create the swimming pool entry
        Swimmingpool::create([
            'user_id'          => Auth::id(),
            'image'            => 'swimmmingpools/'.$imageName,
            'name'             => $request->name,
            'description'      => $request->description,
            'location'         => $request->location,
            'price_per_person' => $request->price_per_person,
        ]);

        return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool created successfully!');
    }

    // Menampilkan detail kolam renang
    public function show(String $id) : View
    {
        $swimmingpools = Swimmingpool::findorFall($id);
        return view('swimmingpools.show', compact('swimmingpool'));
    }
}
