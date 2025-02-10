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
          $swimmingpool = Swimmingpool::all(); // Ambil semua kolam renang dari database
          return view('swimmingpools.index', compact('swimmingpool'));
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
        $imageName = $image->storeAs('swimmingpools', $imageName, 'public');
        // if ($image) {$imagePath = $image->storePubliclyAs('swimmmingpools', $image->hashName(),'s3');}


        // Create the swimming pool entry
        Swimmingpool::create([
            'user_id'          => Auth::id(),
            'image'            => 'swimmingpools/'.$imageName,
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
         // Mencari kolam renang berdasarkan ID
        $swimmingpool = Swimmingpool::findOrFail($id);

        // Mengambil nama pengguna yang terkait dengan kolam renang
        $userName = $swimmingpool->user->name;  // pastikan relasi user() sudah ada di model Swimmingpool

        return view('swimmingpools.show', compact('swimmingpool','userName'));
    }

    public function edit($id)
    {
        // Mencari kolam renang berdasarkan ID yang diberikan atau melemparkan pengecualian jika tidak ditemukan
        $swimmingpool = Swimmingpool::findOrFail($id);

        // Mengirim data kolam renang ke view 'edit'
        return view('swimmingpools.edit', compact('swimmingpool'));
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //get post id
        $swimmingpool = Swimmingpool::findOrFail($id);

        //check if image upload or not
        if ($request->hasFile('image')) {

            //upload new image
            $imageName = $request->file('image');
            $imageName->storeAs(public_path('swimmingpools'), $imageName);

            //delete old image
            unlink(public_path('swimmingpools/'.$swimmingpool->image));

            //update post with new image
            $swimmingpool->update([
                'user_id'          => Auth::id(),
                'image'            => 'swimmingpools/'.$imageName,
                'name'             => $request->name,
                'description'      => $request->description,
                'location'         => $request->location,
                'price_per_person' => $request->price_per_person,
            ]);
        } else {
            //update post without image
            $swimmingpool->update([
                'user_id'          => Auth::id(),
                'name'             => $request->name,
                'description'      => $request->description,
                'location'         => $request->location,
                'price_per_person' => $request->price_per_person,
            ]);
        }
        //redirect to index
        return redirect()->route('swimmingpools.index')->with(['success' => 'Data Successfully Changed!']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) : RedirectResponse
    {
        $swimmingpool = Swimmingpool::findOrFail($id);

        //delete image
        unlink(public_path('swimmingpools/'. $swimmingpool->image));

        //delete post
        $swimmingpool->delete();

        //delete to index
        return redirect()->route('swimmingpools.index')->with(['success' => 'Data Successfully Deleted!']);
    }

    
}
