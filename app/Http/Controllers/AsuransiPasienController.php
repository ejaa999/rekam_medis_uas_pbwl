<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AsuransiPasien;

class AsuransiPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->cek_roles('pasien');

        $validated_data = $request->validate([
            'penyedia' => 'required|max:255',
            'nomor_polis' => 'required|max:255',
            'no_telepon' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $validated_data['pasien_id'] = auth()->user()->id;
        AsuransiPasien::create($validated_data);

        return redirect()->back()->with('success','Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->cek_roles('pasien');

        $validated_data = $request->validate([
            'penyedia' => 'required|max:255',
            'nomor_polis' => 'required|max:255',
            'no_telepon' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        AsuransiPasien::where('id',$id)->update($validated_data);

        return redirect()->back()->with('success','Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cek_roles('pasien');

        AsuransiPasien::where('id',$id)->delete();

        return redirect()->back()->with('success','Berhasil Dihapus');
    }

    public function get_data($id){
        return AsuransiPasien::find($id)->toJSON();
    }
}
