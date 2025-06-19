<?php

namespace App\Http\Controllers;

use App\Models\FormulirPenilaianDisposisi;
use Illuminate\Http\Request;

class FormulirPenilaianDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tersedia()
    {

        $disposisis = FormulirPenilaianDisposisi::with(['formulir', 'indikator', 'fromProfile', 'toProfile', 'assignedProfile'])->get();


        return view('dashboard.disposisi.disposisi-index',compact('disposisis'));
    }


    public function koreksi($id)
    {

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
    public function show(FormulirPenilaianDisposisi $formulirPenilaianDisposisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormulirPenilaianDisposisi $formulirPenilaianDisposisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormulirPenilaianDisposisi $formulirPenilaianDisposisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormulirPenilaianDisposisi $formulirPenilaianDisposisi)
    {
        //
    }
}
