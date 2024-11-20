<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LampiranRekamMedis;
use App\Http\Controllers\Controller;

class LampiranRekamMedisController extends Controller
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
        // save lampiran rekam medis bila ada
        if($request->has('lampiran_rekam_medises')){
            foreach($request->lampiran_rekam_medises as $lampiran){


                $original_name = $lampiran->getClientOriginalName();
                $file_path = $lampiran->store('lampiran_rekam_medis');

                LampiranRekamMedis::create([
                    'rekam_medis_id' => $request->rekam_medis_id,
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
        LampiranRekamMedis::where('id',$id)->delete();

        return redirect()->back()->with('success','Berhasil dihapus');
    }
}
