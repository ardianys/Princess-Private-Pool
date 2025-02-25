<?php

namespace App\Http\Controllers;

use App\Models\Swimmingpool;
use App\Models\Swimmingpoolschedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SwimmingpoolscheduleController extends Controller
{
    // Menampilkan daftar jadwal
    public function index() : View
    {
        $schedules = Swimmingpoolschedule::paginate(10);

        return view('schedules.index', compact('schedules'));
    }

    // Menampilkan form tambah jadwal
    public function create() : View
    {
        // $swimmingpool = Swimmingpool::findOrFail($swimmingpool_id);
        return view('schedules.create');
    }

    // Menyimpan jadwal baru
    public function store(Request $request, $swimmingpool_id)
    {
        $request->validate([
            'day'             => 'required|string',
            'start_time'      => 'required',
            'end_time'        => 'required',
            'max_people'      => 'required|integer|min:1',
        ]);

        Swimmingpoolschedule::create([
            'swimmingpool_id'   => $swimmingpool_id,
            'day'               => $request->day,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
            'max_people'        => $request->max_people,
            'current_people'    => 0,
        ]);

        return redirect()->route('swimmingpools.show', $swimmingpool_id)->with('success', 'Schedule successfully created!');
    }

    // Menampilkan detail jadwal
    public function show($id)
    {
        $schedule = Swimmingpoolschedule::findOrFail($id);
        return view('schedules.show', compact('schedule'));
    }

    // Menampilkan form edit jadwal
    public function edit($id)
    {
        $schedule = Swimmingpoolschedule::findOrFail($id);
        return view('schedules.edit', compact('schedule'));
    }

    // Menyimpan perubahan pada jadwal
    public function update(Request $request, $id)
    {
        $schedule = Swimmingpoolschedule::findOrFail($id);

        $request->validate([
            'day'             => 'required|string',
            'start_time'      => 'required',
            'end_time'        => 'required',
            'max_people'      => 'required|integer|min:1',
        ]);

        Swimmingpoolschedule::update([
            // 'swimmingpool_id'   => $swimmingpool_id,
            'day'               => $request->day,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
            'max_people'        => $request->max_people,
            'current_people'    => 0,
        ]);

        // $schedule->update($request->all());

        return redirect()->route('swimmingpools.show', $schedule->swimmingpool_id)->with('success', 'Schedule successfully update!');
    }

    // Menghapus jadwal
    public function destroy($id)
    {
        $schedule = Swimmingpoolschedule::findOrFail($id);
        $swimmingpool_id = $schedule->swimmingpool_id;
        $schedule->delete();

        return redirect()->route('swimmingpools.show', $swimmingpool_id)->with('success', 'Schedule successfully deleted!');
    }
}
