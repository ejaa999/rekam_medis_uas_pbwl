<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaskesHasTenagaKesehatan;

class FaskesHasTenagaKesehatanController extends Controller
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
        $this->cek_roles('tenaga_kesehatan');

        $validated_data = $request->validate([
            'faskes_id' => 'required|numeric',
            'spesialisasi' => 'required|max:255'
        ]);

        $validated_data['tenaga_kesehatan_id'] = auth()->user()->id;
        FaskesHasTenagaKesehatan::create($validated_data);

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
        $this->cek_roles('tenaga_kesehatan');

        $validated_data = $request->validate([
            'faskes_id' => 'required|numeric',
            'spesialisasi' => 'required|max:255'
        ]);

        FaskesHasTenagaKesehatan::where('id',$id)->update($validated_data);

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
        $this->cek_roles('tenaga_kesehatan');

        FaskesHasTenagaKesehatan::where('id',$id)->delete();

        return redirect()->back()->with('success','Berhasil Dihapus');
    }

    public function get_data($id){
        return FaskesHasTenagaKesehatan::find($id)->toJSON();
    }
}
