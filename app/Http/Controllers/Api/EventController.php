<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $category = $request->input('kategori');
        $province = $request->input('provinsi');
        $date = $request->input('tanggal');

        $query = Event::query()->where('status', 1);

        if ($category) {
            $query->where('kategori', $category);
        }

        if ($province) {
            $query->where('provinsi', $province);
        }

        if ($date) {
            $query->where('mulai', 'LIKE', '%' . $date . '%');
        }

        $events = $query->orderBy('mulai', 'asc')->get();

        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::query()
            ->with('tickets')
            ->where('status', 1)
            ->where('id', $id)->first();

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
