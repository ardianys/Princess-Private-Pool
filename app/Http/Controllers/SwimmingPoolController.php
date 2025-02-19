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
            'operational_days'  => 'required|array',
            'operational_days.*'=> 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'opening_time'      => 'required|date_format:H:i',
            'closing_time'      => 'required|date_format:H:i|after:opening_time',
            'price_per_person'  => 'nullable|numeric|min:1',  
        ]);  

         //upload image
         $imagePath = $request->file('image')->store('swimmingpools', 'public');

        //  $image = $request->file('image');
        //  if ($image) {$imagePath = $image->store('public/swimmingpools');}
        // $image = $request->file('image');  
        // $imagePath = $image->storeAs('swimmingpools', $image->hashName(), 'public');  

        Swimmingpool::create([  
            'user_id'           => Auth::id(),  
            'image'             => isset($imagePath) ? $request->file('image')->hashName() : null,
            'name'              => $request->name,  
            'description'       => $request->description,  
            'location'          => $request->location,
            'operational_days'  => json_encode($request->operational_days),  
            'opening_time'      => $request->opening_time,  
            'closing_time'      => $request->closing_time, 
            'price_per_person'  => json_decode($request->price_per_person, true),  
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
            'image'             => 'required|image|mimes:jpeg,jpg,png|max:2048',  
            'name'              => 'required|string',  
            'description'       => 'nullable|string',  
            'location'          => 'nullable|string',
            'operational_days'  => 'required|array',
            'operational_days.*'=> 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'opening_time'      => 'required|date_format:H:i',
            'closing_time'      => 'required|date_format:H:i|after:opening_time',
            'price_per_person'  => 'nullable|numeric|min:1',
        ]);  

        // Cek jika ada gambar baru diupload  
        if ($request->hasFile('image')) {  

            // Hapus gambar lama  
            if ($swimmingpool->image && Storage::exists('public/' . $swimmingpool->image)) {  
                Storage::delete('public/' . $swimmingpool->image);  
            }  

            // Upload gambar baru  
            $imagePath = $request->file('image')->store('swimmingpools', 'public');  
            $swimmingpool->image = $imagePath;
        }

            //update pwithout image
            $swimmingpool->update([
                'name'              => $request->name,  
                'description'       => $request->description,  
                'location'          => $request->location,
                'operational_days'  => json_encode($request->operational_days),  
                'opening_time'      => $request->opening_time,  
                'closing_time'      => $request->closing_time,
                'price_per_person'  => json_docode($request->price_per_person, true),
            ]);

        return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool updated successfully!');  
    }  

    // Menghapus kolam renang  
    public function destroy($id): RedirectResponse  
    {  
        // //delete image
        // Storage::delete('public/swimmingpools/'. $swimmingpool->image);

        // //delete post
        // $swimmingpool->delete();
        $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  

        // Hapus gambar dari storage jika ada  
        if ($swimmingpool->image && Storage::exists('storage/' . $swimmingpool->image)) {  
            Storage::delete('public/' . $swimmingpool->image);  
        }  

        $swimmingpool->delete(); // Hapus kolam renang dari database  
        
        return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool deleted successfully!');  
    }  
}