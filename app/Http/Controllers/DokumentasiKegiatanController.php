<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Models\DokumentasiKegiatan;

class DokumentasiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumentasis = Formulir::with('dokumentasi')->latest()->get();

        // dd($formulirs);
        return view('dashboard.dokumentasi.dokumentasi-index', compact('dokumentasis'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Formulir $formulir)
    {
     $totalIndikator = 0;
        $terisi = 0;

        // Load relasi sampai penilaian
        $formulir->load(['formulir_domains.domain.aspek.indikator.penilaian','dokumentasi']);

        foreach ($formulir->formulir_domains as $formulirDomain) {
            $domain = $formulirDomain->domain;

            foreach ($domain->aspek as $aspek) {
                foreach ($aspek->indikator as $indikator) {
                    $totalIndikator++;

                    // Hitung hanya penilaian untuk formulir & user saat ini (jika pakai filter)
                    if ($indikator->penilaian->where('formulir_id', $formulir->id)->isNotEmpty()) {
                        $terisi++;
                    }
                }
            }
        }

        $persentase = $totalIndikator > 0 ? round(($terisi / $totalIndikator) * 100, 2) : 0;


        // dd($formulir);
        return view('dashboard.dokumentasi.dokumentasi-show', compact('formulir','persentase', 'totalIndikator', 'terisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DokumentasiKegiatan $dokumentasiKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DokumentasiKegiatan $dokumentasiKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DokumentasiKegiatan $dokumentasiKegiatan)
    {
        //
    }
}
