<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aspek;
use App\Models\Domain;
use App\Models\Formulir;
use App\Models\FormulirPenilaianDisposisi;
use App\Models\Indikator;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{


    // public function dashboardPenilaian()
    // {

    //     return view('dashboard.penilaian.domain-penilaian');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['kegiatanPenilaian'] = Formulir::with('domain.aspek.indikator.penilaian')->whereDoesntHave('domain.aspek.indikator.penilaian', function ($query) {
            $query->whereNull('nilai');
        })->latest()->get();




        // dd($data);

        // dd($data['kegiatanPenilaian']);
        // $data['jumlahKegiatanPenilaian'] = Formulir::count();
        // $data['jumlahPenilaianSelesai'] = Formulir::count();
        // $data['jumlahPenilaianProgres'] = Formulir::count();
        // $data['userTerdaftar'] = User::count();

        foreach ($data['kegiatanPenilaian'] as $formulir) {
            $totalIndikator = 0;
            $terisi = 0;

            foreach ($formulir->domain as $domain) {
                foreach ($domain->aspek as $aspek) {
                    $totalIndikator += $aspek->indikator->count();
                    foreach ($aspek->indikator as $indikator) {
                        if ($indikator->penilaian->where('user_id', Auth::user()->id)->where('formulir_id', $formulir->id)->isNotEmpty()) {
                            $terisi++;
                        }
                    }
                }

                $formulir->total_indikator = $totalIndikator;
                $formulir->indikator_terisi = $terisi;
                $formulir->persentase = $totalIndikator > 0 ? round(($terisi / $totalIndikator) * 100, 2) : 0;
            }

            // Simpan ke property tambahan agar bisa diakses di blade

        }


        // dd($terisi);




        return view('dashboard.penilaian.penilaian-index', $data);
    }


    public function penilaianTersedia(Formulir $formulir)
    {


        $totalIndikator = 0;
        $terisi = 0;

        $formulir->load('domain.aspek.indikator');


        foreach ($formulir->domain as $domain) {
            foreach ($domain->aspek as $aspek) {
                $totalIndikator += $aspek->indikator->count();
                foreach ($aspek->indikator as $indikator) {

                    if ($indikator->penilaian->isNotEmpty()) {
                        $terisi++;
                    }
                }
            }
        }


        // dd($totalIndikator,$terisi);

        $persentase = $totalIndikator > 0 ? round(($terisi / $totalIndikator) * 100, 2) : 0;


        // dd($persentase);

        // dd($formulir);
        return view('dashboard.penilaian.penilaian', compact('formulir', 'persentase', 'totalIndikator', 'terisi'));
    }


    //  formulir/{1}/domain-penilaian

    public function domainPenilaian(Formulir $formulir)
    {
        $formulir->load('domain.aspek.indikator');

        // dd($formulir);
        return view('dashboard.penilaian.domain-penilaian', compact('formulir'));
    }



    public function isiDomain(Formulir $formulir, $nama_domain)
    {


        $domain = Domain::where('formulir_id', $formulir->id)->where('nama_domain', $nama_domain)->first();
        $formulir->load('domain.aspek.indikator');
        return view('dashboard.penilaian.isi-domain-aspek-penilaian', compact(['formulir', 'domain']));
    }


    public function penilaianAspek(Formulir $formulir, $nama_domain, $aspek, $req_indikator)
    {
        $domain = Domain::where('formulir_id', $formulir->id)->where('nama_domain', $nama_domain)->first();
        $aspek = Aspek::where('domain_id', $domain->id)->where('nama_aspek', $aspek)->first();
        $indikator = Indikator::with('penilaian')->where('aspek_id', $aspek->id)->where('nama_indikator', $req_indikator)->first();
        $formulir->load('domain.aspek.indikator');

        $dinilai = Indikator::with('penilaian')->whereHas('penilaian', function ($query) use ($indikator) {
            $query->where('user_id', Auth::user()->id)->where('nilai', '!=', null)->where('indikator_id', $indikator->id);
        })->where('nama_indikator', $req_indikator)->first();


        //  $dinilai = Indikator::whereHas('penilaian',function($query) {
        //     $query->where('user_id', Auth::user()->id)->where('nilai', '!=', null);
        // })->where('')->get();

        // dd($dinilai->penilaian);
        // dd($dinilai);
        return view('dashboard.penilaian.sesi-penilaian', compact('formulir', 'domain', 'aspek', 'indikator', 'dinilai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Formulir $formulir, $nama_domain, $aspek, $indikator)
    {


        $request->validate([
            'nilai' => 'required|numeric',
        ], [
            'nilai.required' => 'Tingkat kematangan harus diisi',
        ]);

        $penilaian = Penilaian::create([
            'indikator_id' => $indikator,
            'nilai' => $request->nilai,
            'tanggal_penilaian' => date('Y-m-d'),
            'formulir_id' => $formulir->id,
            'user_id' =>  Auth::user()->id
        ]);

        if ($penilaian) {
            FormulirPenilaianDisposisi::create([
                'formulir_id' => $formulir->id,
                'indikator_id' => $indikator,
                'assigned_profile_id' => Auth::user()->id,
                'status' => 'sent',
                'is_completed' => false,

            ]);
        }

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formulir $formulir, Penilaian $penilaian)
    {
        return view('dashboard.penilaian.penilaian', compact('formulir', 'penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formulir $formulir, Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formulir $formulir, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formulir $formulir, Penilaian $penilaian)
    {
        //
    }
}
