<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class MarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Marker::get();
        alert()->html('<h4>Add Marker Map</h4>'," 1. Kamu bisa menambahkan marker dengan mengklik bagian manapun pada map  <br/> 2. Tekan icon pada map untuk melihat detail informasi dan menghapus marker  <br/> 3. Selamat Mencoba...",'info');
        return view('welcome',[
            'spaces' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'description' => 'required',
        ]);

        $data = new Marker();

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->address = $request->input('address');
        $data->latitude = $request->input('latitude');
        $data->longitude = $request->input('longitude');
        $data->description = $request->input('description');

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
     *
     * @param  \App\Models\Marker  $marker
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Marker::get();
        alert()->html('<h4>Read Only Map</h4>'," 1. Kamu hanya bisa melihat informasi pada map ini  <br/> 2. Tekan icon pada map untuk melihat detail informasi  <br/> 3. Silahkan kunjungi link berikut untuk menambahkan dan menghapus marker <a href='/map'>Add Marker Map</a>",'info');
        return view('landing-page',[
            'spaces' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marker  $marker
     * @return \Illuminate\Http\Response
     */
    public function edit(Marker $marker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marker  $marker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marker $marker)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marker  $marker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marker = Marker::find($id);
        $marker->delete();
        return redirect('/map');
    }
}
