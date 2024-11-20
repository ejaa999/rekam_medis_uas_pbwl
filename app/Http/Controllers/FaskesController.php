<?php

namespace App\Http\Controllers;

use App\Models\Faskes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->cek_roles('admin');

        $data['faskeses'] = Faskes::where('visibility',1)->get();

        return view('faskes.index',$data);
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
        $this->cek_roles('admin');

        $validated_data = $request->validate([
            'nama' => 'required|max:255',
            'tipe_faskes' => 'required|numeric',
            'alamat' => 'required|max:255,',
            'provinsi' => 'required|max:255,',
            'kota' => 'required|max:255,'
        ]);

        Faskes::create($validated_data);

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
        $this->cek_roles('admin');

        $validated_data = $request->validate([
            'nama' => 'required|max:255',
            'tipe_faskes' => 'required|numeric',
            'alamat' => 'required|max:255,',
            'provinsi' => 'required|max:255,',
            'kota' => 'required|max:255,'
        ]);

        Faskes::where('id',$id)->update($validated_data);

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
        $this->cek_roles('admin');
        
        Faskes::where('id',$id)->update(['visibility' => 0]);

        return redirect()->back()->with('success','Berhasil Dihapus');
    }

    public function get_data($faskes_id){
        return Faskes::find($faskes_id)->toJSON();
    }
}
