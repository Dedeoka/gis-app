<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Rumahsakit;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('add-pages.layanan-pages');
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
            'operational' => 'required',
            'image_name' => '',
        ]);

        $data = new Layanan();
        $rumahsakit_id = Rumahsakit::latest()->first()->id;

        $data->rumahsakit_id = $rumahsakit_id;
        $data->name = $request->input('name');
        $data->operational = $request->input('operational');
        $data->image_name = $request->input('image_name');
        $data->save();

        if ($data) {
            return redirect('/room');
        } else {
            return redirect('/layanan');
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
