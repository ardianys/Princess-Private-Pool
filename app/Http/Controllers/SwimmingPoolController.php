<?php  

namespace App\Http\Controllers;  

use App\Models\Swimmingpool;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Storage;  
use Illuminate\View\View;  
use Illuminate\Http\RedirectResponse;  

class SwimmingpoolController extends Controller  
{  

    // Menampilkan daftar semua kolam renang  
    public function index(): View  
    {  
        $swimmingpools = Swimmingpool::all(); // Mengambil semua data kolam renang  
        return view('swimmingpools.index', compact('swimmingpools'));  
    }  

    // Menampilkan form untuk membuat kolam renang  
    public function create(): View  
    {  
        return view('swimmingpools.create');  
    }  

    // Menyimpan kolam renang yang baru dibuat  
    public function store(Request $request): RedirectResponse  
    {  
        $request->validate([  
            'image'             => 'required|image|mimes:jpeg,jpg,png|max:2048',  
            'name'              => 'required|string',  
            'description'       => 'nullable|string',  
            'location'          => 'nullable|string',  
            'price_per_person'  => 'nullable|numeric|min:1',  
        ]);  

         //upload image
         $image = $request->file('image');
         if ($image) {$imagePath = $image->storeAs('public/swimmingpools', $image->hashName());}
 

        // $image = $request->file('image');  
        // $imagePath = $image->storeAs('swimmingpools', $image->hashName(), 'public');  

        Swimmingpool::create([  
            'user_id'           => Auth::id(),  
            'image'             => isset($imagePath) ? $request->file('image')->hashName() : null,
            // 'image' => $imagePath,  
            'name'              => $request->name,  
            'description'       => $request->description,  
            'location'          => $request->location,  
            'price_per_person'  => $request->price_per_person,  
        ]);  

        return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool created successfully!');  
    }  

    // Menampilkan detail kolam renang berdasarkan ID  
    public function show($id): View  
    {  
        $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  
        return view('swimmingpools.show', compact('swimmingpool'));  
    }  

    // Menampilkan form untuk mengedit kolam renang  
    public function edit($id): View  
    {  
        $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  
        return view('swimmingpools.edit', compact('swimmingpool'));  
    }  

    // Memperbarui data kolam renang  
    public function update(Request $request, $id): RedirectResponse  
    {  
        $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  

        $request->validate([  
            'user_id'           => Auth::id(),  
            'image'             => $image->hashName(),
            // 'image' => $imagePath,  
            'name'              => $request->name,  
            'description'       => $request->description,  
            'location'          => $request->location,  
            'price_per_person'  => $request->price_per_person, 
        ]);  

        // Cek jika ada gambar baru diupload  
        if ($request->hasFile('image')) {  

             //upload new image
             $image = $request->file('image');
             $image->storeAs('public/swimmingpools', $image->hashName());
 
             //delete old image
             Storage::delete('public/swimmingpools'.$swimmingpool->image);

             //update with new image
            $swimmingpool->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'content'       => $request->content,
                'reporter'      => $request->reporter,
                'source'        => $request->source
            ]);
        } else {
            //update pwithout image
            $swimmingpool->update([
                'title'         => $request->title,
                'content'       => $request->content,
                'reporter'      => $request->reporter,
                'source'        => $request->source
            ]);
        }
        //     // Hapus gambar lama jika ada  
        //     if ($swimmingpool->image && Storage::exists('public/' . $swimmingpool->image)) {  
        //         Storage::delete('public/' . $swimmingpool->image);  
        //     }  

        //     $image = $request->file('image');  
        //     $imagePath = $image->storeAs('swimmingpools', $image->hashName(), 'public');  
        //     $swimmingpool->image = $imagePath; // Simpan path gambar baru  
        // }  

        // $swimmingpool->fill($request->except(['image'])); // Update kolam renang kecuali gambar  
        // $swimmingpool->save(); // Simpan perubahan  

        return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool updated successfully!');  
    }  

    // Menghapus kolam renang  
    public function destroy($id): RedirectResponse  
    {  
        //delete image
        Storage::delete('public/swimmingpools/'. $swimmingpool->image);

        //delete post
        $swimmingpool->delete();
        // $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  

        // // Hapus gambar dari storage jika ada  
        // if ($swimmingpool->image && Storage::exists('public/' . $swimmingpool->image)) {  
        //     Storage::delete('public/' . $swimmingpool->image);  
        // }  

        // $swimmingpool->delete(); // Hapus kolam renang dari database  
        
        return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool deleted successfully!');  
    }  
}