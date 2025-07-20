<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use App\Models\Formulir;
use App\Models\Indikator;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FormulirPenilaianDisposisi;

class FormulirPenilaianDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tersedia()
    {

        $penilaianSelesai = Formulir::whereHas('formulir_penilaian_diposisi')->get();
        $countMaxPeserta = User::whereRole('opd')->count();
        $progresPenialian = '';
        // dd($disposisis);

        return view('dashboard.disposisi.disposisi-index', compact('penilaianSelesai', 'countMaxPeserta'));
    }


    public function detail($formulir)
    {
        $formulir = Formulir::whereNamaFormulir($formulir)->first();
        $opdsMenilai = User::with('penilaians.formulir.formulir_domains.domain.aspek.indikator')->whereHas('penilaians', function ($query) use ($formulir) {
            $query->where('formulir_id', $formulir->id);
        })->get()->map(function ($opd) use ($formulir) {
            return [
                'opd' => $opd,
                'domains' => $opd->penilaians->where('formulir_id', $formulir->id)->map(function ($penilaian) {
                    return $penilaian->formulir->formulir_domains->map(function ($fd) {
                        return $fd->domain;
                    });
                })->flatten()->unique()
            ];
        });
        // $opdsMenilai = Formulir::with(['formulir_penilaian_diposisi','penilaians'])->where('id', $formulir->id)->first();

        // dd($opdsMenilai);
        return view('dashboard.disposisi.disposisi-detail', compact('formulir', 'opdsMenilai'));
    }


    public function koreksiIsiDomain($opd, $formulir, $domain)
    {
        $opd = User::where('name', $opd)->first();


        $formulir = Formulir::where('nama_formulir', $formulir)->first();
        $domain = Domain::where('nama_domain', $domain)->first();
        $formulir->load('formulir_domains.domain.aspek.indikator.penilaian');


        // dd($formulir);
        return view('dashboard.disposisi.koreksi-detail-isi-domain', compact('formulir', 'domain', 'opd'));
    }


    public function koreksi($opd, $formulir, $domain, $aspek, $indikator)
    {
        // dd($formulir);
        $opd = User::where('name', $opd)->first();
        $formulir = Formulir::where('nama_formulir', $formulir)->first();
        $domain = Domain::where('nama_domain', $domain)->first();
        $aspek = $domain->aspek()->where('nama_aspek', $aspek)->first();
        $indikator = $aspek->indikator()->where('nama_indikator', $indikator)->first();
        // $dinilai = Indikator::with('penilaian')->whereHas('penilaian', function ($query) use ($indikator, $formulir) {
        //     $query->where('user_id', Auth::user()->id)->where('nilai', '!=', null)->where('indikator_id', $indikator->id)->whereFormulirId($formulir->id);
        // });

        // dd($opd);
        $nilai_diinput = Penilaian::where('user_id', $opd->id)->where('formulir_id', $formulir->id)->where('indikator_id', $indikator->id)->first();
        $nilai_dikoreksi = Penilaian::where('user_id', $opd->id)->where('formulir_id', $formulir->id)
            ->where('indikator_id', $indikator->id)->where('nilai_koreksi', '!=', null)->first();
        // dd($nilai_dikoreksi);
        return view('dashboard.disposisi.koreksi-penilaian', compact('opd', 'formulir', 'domain', 'aspek', 'indikator', 'nilai_diinput','nilai_dikoreksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeKoreksi(Request $request)
    {
        $penilaian = Penilaian::find($request->penilaian_id);
        $pengoreksi = Auth::user()->id;


        // dd($penilaian);
        $penilaian->update([
            'nilai_koreksi' => $request->nilai,
            'pengoreksi' => $pengoreksi
        ]);


        return redirect()->back()->with('success', 'Berhasil mengoreksi penilaian');
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
