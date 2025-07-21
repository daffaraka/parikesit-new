<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $pesertas = User::whereIn('role',['opd','walidata'])->get();
        return view('dashboard.pembinaan.pembinaan-create',compact('pesertas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Pembinaan $pembinaan)
    {

        $pembinaan->load(['peserta_pembinaan' => function ($query) {
            $query->where('peserta_id', auth()->id());
        }]);


        dd($pembinaan);
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
        $nama_bukti_pembinaan = $pembinaan->id.'_'.time().'.'.$bukti_pembinaan->getClientOriginalExtension();
        $bukti_pembinaan->storeAs('bukti_pembinaan', $nama_bukti_pembinaan);

        Pembinaan::create([
            'profile_id' => Auth::user()->id,
            'peserta_id' => $pembinaan->peserta_pembinaan->first()->id,
            'penjadwalan_id' => $pembinaan->id,
            'judul_pembinaan' => $pembinaan->judul_jadwal,
            'tanggal_pembinaan' => $pembinaan->tanggal_jadwal,
            'ringkasan_pembinaan' => $request->ringkasan_pembinaan,
            'bukti_pembinaan' => $nama_bukti_pembinaan,
            'pemateri' => $pembinaan->nama_pemateri,
        ]);

        return redirect()->back()->with('success', 'Pembinaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembinaan $pembinaan)
    {


        // dd($pembinaan);
        return view('dashboard.pembinaan.pembinaan-show',compact('penjadwalan'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembinaan $pembinaan)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembinaan $pembinaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembinaan $pembinaan)
    {
        //
    }
}
