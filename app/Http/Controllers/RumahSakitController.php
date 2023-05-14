<?php

namespace App\Http\Controllers;

use App\Models\Room_facility;
use Illuminate\Http\Request;
use App\Models\Rumahsakit;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rumahsakit::get();
        return view('welcome', compact('data'));
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
            'type' => 'required',
            'kelas' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'operational' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'description' => 'required',
            'thumbnail_name' => 'required',
        ]);

        $data = new Rumahsakit();

        $data->name = $request->input('name');
        $data->type = $request->input('type');
        $data->kelas = $request->input('kelas');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->operational = $request->input('operational');
        $data->address = $request->input('address');
        $data->latitude = $request->input('latitude');
        $data->longitude = $request->input('longitude');
        $data->description = $request->input('description');

        $proof = $request->file('thumbnail_name');
        $path = 'foto/rumahsakit';
        $nama_file = $request->name."_".$proof->getClientOriginalName();
        $proof->move($path,$nama_file);
        $data->thumbnail_name = $nama_file;

        // return dd($data);

        $data->save();

        if ($data) {
            return redirect('/map');
        } else {
            return redirect('/map');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumahsakits = Rumahsakit::where('id', $id)->with('layanans.type', 'rooms.images')->firstOrFail();

        return view('detail', compact('rumahsakits'));
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
        $marker = Rumahsakit::find($id);
        $marker->delete();
        return redirect('/map');
    }
}
