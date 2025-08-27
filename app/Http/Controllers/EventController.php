<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Tampilkan daftar event
    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Event::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('events.index', compact('events', 'search'));
    }

    // Tampilkan form tambah event
    public function create()
    {
        return view('events.create');
    }

    // Simpan event baru (dibuat karyawan)
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'reward'      => 'required|numeric|min:0',
            'date'        => 'required|date',
        ]);

        // Simpan event dengan status "comingsoon" (pending approval)
        $event = Event::create([
            'name'        => $request->name,
            'description' => $request->description,
            'reward'      => $request->reward,
            'date'        => Carbon::parse($request->date),
            'status'      => 'comingsoon',
        ]);

        // Ambil employee_id dari user login
        $employeeId = Auth::user()->employee->id; // pastikan ada relasi User->employee

        // Daftarkan pembuat event sebagai peserta otomatis
        EventAttendance::create([
            'employee_id' => $employeeId,
            'event_id'    => $event->id,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil diajukan, menunggu persetujuan admin.');
    }


    // Update status event (approve atau reject)
    public function updateStatus(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|in:approve,reject',
        ]);

        $event->status = $request->status;
        $event->save();

        return redirect()->route('events.admin')->with('success', 'Status event berhasil diperbarui.');
    }
    public function admin(Request $request)
    {
        $query = Event::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Urutkan dari tanggal terbaru
        $events = $query->orderBy('date', 'desc')->paginate(10); // 10 item per halaman

        return view('events.admin', compact('events'));
    }
}
