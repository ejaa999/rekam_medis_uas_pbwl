<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratIjinPraktek;
use App\Http\Controllers\Controller;

class SuratIjinPraktekController extends Controller
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
        // save surat ijin praktek bila ada
        if($request->has('surat_ijin_prakteks')){
            foreach($request->surat_ijin_prakteks as $surat_ijin_praktek){


                $original_name = $surat_ijin_praktek->getClientOriginalName();
                $file_path = $surat_ijin_praktek->store('surat_ijin_praktek');
                SuratIjinPraktek::create([
                    'tenaga_kesehatan_id' => auth()->user()->id,
                    'original_name' => $original_name,
                    'file_path' => $file_path
                ]);
            }
        }

        return redirect()->back()->with('success','Berhasil ditambah');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SuratIjinPraktek::where('id',$id)->delete();

        return redirect()->back()->with('success','Berhasil dihapus');
    }
}
