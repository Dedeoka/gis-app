<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Room_image;
use App\Models\Rumahsakit;
use App\Models\Room_facility;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('add-pages.room-pages');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'visiting_hours' => 'required',
            'capacity' => 'required',
            'type' => 'required',
            'facilities_name' => 'required',
            'image_name' => '',
        ]);

        $data = new Room();
        $image = new Room_image();
        $facilities = new Room_facility();
        $rumahsakit_id = Rumahsakit::latest()->first()->id;

        $data->rumahsakit_id = $rumahsakit_id;
        $data->name = $request->input('name');
        $data->visiting_hours = $request->input('visiting_hours');
        $data->capacity = $request->input('capacity');
        $data->type = $request->input('type');
        $data->save();

        $image->room_id = $data->id;
        $image->image_name = $request->input('image_name');
        $image->save();

        $facilities->room_id = $data->id;
        $facilities->facilities_name = $request->input('facilities_name');
        $facilities->save();

        if ($data) {
            return redirect('/map');
        } else {
            return redirect('/room');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
