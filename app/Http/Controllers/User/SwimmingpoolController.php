<?php  

namespace App\Http\Controllers\User;  

use App\Models\Swimmingpool;  
use Illuminate\Http\Request;  
use App\Http\Controllers\Controller; 
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
        return view('customer.swimmingpools.index', compact('swimmingpools'));  
    }  

    // // Menampilkan form untuk membuat kolam renang  
    // public function create(): View  
    // {  
    //     return view('swimmingpools.create');  
    // }  

    // // Menyimpan kolam renang yang baru dibuat  
    // public function store(Request $request): RedirectResponse  
    // {  
    //     $request->validate([  
    //         'image'             => 'required|image|mimes:jpeg,jpg,png|max:2048',  
    //         'name'              => 'required|string',  
    //         'description'       => 'nullable|string',  
    //         'location'          => 'nullable|string',
    //         'price_per_person'  => 'nullable|numeric|min:1',  
    //     ]);  

    //      //upload image
    //      $imagePath = $request->file('image')->store('swimmingpools', 'public');

    //     Swimmingpool::create([  
    //         'user_id'           => Auth::id(),  
    //         'image'             => isset($imagePath) ? $request->file('image')->hashName() : null,
    //         'name'              => $request->name,  
    //         'description'       => $request->description,  
    //         'location'          => $request->location,
    //         // 'price_per_person'  => $request->price_per_person,  
    //     ]);  

    //     return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool created successfully!');  
    // }  

    // Menampilkan detail kolam renang berdasarkan ID  
    public function show($id): View  
    {  
        $swimmingpool = Swimmingpool::with('allotments')->findOrFail($id); // Mengambil kolam renang berdasarkan ID  
        return view('customer.swimmingpools.show', compact('swimmingpool'));  
    }  

    // // Menampilkan form untuk mengedit kolam renang  
    // public function edit($id): View  
    // {  
    //     $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  
    //     return view('swimmingpools.edit', compact('swimmingpool'));  
    // }  

    // // Memperbarui data kolam renang  
    // public function update(Request $request, $id): RedirectResponse  
    // {  
    //     $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  

    //     $request->validate([  
    //         'image'             => 'nullable|image|mimes:jpeg,jpg,png|max:2048',  
    //         'name'              => 'required|string',  
    //         'description'       => 'nullable|string',  
    //         'location'          => 'nullable|string',
    //         'price_per_person'  => 'nullable|numeric|min:1',
    //     ]);  

    //     // Cek jika ada gambar baru diupload  
    //     if ($request->hasFile('image')) {  

    //         // Hapus gambar lama  
    //         if ($swimmingpool->image && Storage::exists('public/' . $swimmingpool->image)) {  
    //             Storage::delete('public/' . $swimmingpool->image);  
    //         }  

    //         // Upload gambar baru  
    //         $imagePath = $request->file('image')->store('swimmingpools', 'public');  
    //         $swimmingpool->image = $imagePath;
    //     }

    //         //update without image
    //         $swimmingpool->update([
    //             'name'              => $request->name,  
    //             'description'       => $request->description,  
    //             'location'          => $request->location,
    //             'price_per_person'  => $request->price_per_person,
    //         ]);

    //     return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool updated successfully!');  
    // }  

    // // Menghapus kolam renang  
    // public function destroy($id): RedirectResponse  
    // {  
    //     $swimmingpool = Swimmingpool::findOrFail($id); // Mengambil kolam renang berdasarkan ID  

    //     // Hapus gambar dari storage jika ada  
    //     if ($swimmingpool->image && Storage::exists('storage/' . $swimmingpool->image)) {  
    //         Storage::delete('public/' . $swimmingpool->image);  
    //     }  

    //     $swimmingpool->delete(); // Hapus kolam renang dari database  
        
    //     return redirect()->route('swimmingpools.index')->with('success', 'Swimming pool deleted successfully!');  
    // }  
}