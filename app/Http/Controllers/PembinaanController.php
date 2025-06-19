<?php

namespace App\Http\Controllers;

use App\Models\Pembinaan;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembinaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pembinaanSelesai = Penjadwalan::whereHas('pembinaan')->get();

        $pembinaanBelumSelesai = Penjadwalan::whereDoesntHave('pembinaan')->get();


        return view('dashboard.pembinaan.pembinaan-index', compact('pembinaanSelesai','pembinaanBelumSelesai'));
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
    public function store(Request $request,Penjadwalan $penjadwalan)
    {

        $penjadwalan->load(['peserta_pembinaan' => function ($query) {
            $query->where('peserta_id', auth()->id());
        }]);


        dd($penjadwalan);
        $request->validate([
            'ringkasan_pembinaan' => 'required|string|max:255',
            'bukti_pembinaan' => 'required|file|mimes:jpg,png,webp,svg,jpeg|max:4096',
            'pemateri' => 'required|string',
        ], [
            'ringkasan_pembinaan.required' => 'Ringkasan pembinaan harus diisi',
            'ringkasan_pembinaan.string' => 'Ringkasan pembinaan harus berupa string',
            'ringkasan_pembinaan.max' => 'Ringkasan pembinaan maksimal 255 karakter',
            'bukti_pembinaan.required' => 'Bukti pembinaan harus diisi',
            'bukti_pembinaan.file' => 'Bukti pembinaan harus berupa file',
            'bukti_pembinaan.mimes' => 'Bukti pembinaan harus berupa jpg,png,webp,svg,jpeg',
            'pemateri.required' => 'Pemateri harus diisi',
            'pemateri.string' => 'Pemateri harus berupa string',
            'pemateri.max' => 'Pemateri maksimal 255 karakter',
        ]);

        $bukti_pembinaan = $request->file('bukti_pembinaan');
        $nama_bukti_pembinaan = $penjadwalan->id.'_'.time().'.'.$bukti_pembinaan->getClientOriginalExtension();
        $bukti_pembinaan->storeAs('bukti_pembinaan', $nama_bukti_pembinaan);

        Pembinaan::create([
            'profile_id' => Auth::user()->id,
            'peserta_id' => $penjadwalan->peserta_pembinaan->first()->id,
            'penjadwalan_id' => $penjadwalan->id,
            'judul_pembinaan' => $penjadwalan->judul_jadwal,
            'tanggal_pembinaan' => $penjadwalan->tanggal_jadwal,
            'ringkasan_pembinaan' => $request->ringkasan_pembinaan,
            'bukti_pembinaan' => $nama_bukti_pembinaan,
            'pemateri' => $penjadwalan->nama_pemateri,
        ]);

        return redirect()->back()->with('success', 'Pembinaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjadwalan $penjadwalan)
    {


        // dd($penjadwalan);
        return view('dashboard.pembinaan.pembinaan-show',compact('penjadwalan'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjadwalan $penjadwalan)
    {
        //
    }
}
