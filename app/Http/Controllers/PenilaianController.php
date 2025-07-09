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

    public function index()
    {
        $data['title'] = 'Dashboard';

        // Ambil formulir yang indikatornya semua sudah dinilai (user tertentu bisa disesuaikan)
        $data['kegiatanPenilaian'] = Formulir::with('domains.aspek.indikator.penilaian')
            ->whereDoesntHave('domains.aspek.indikator.penilaian', function ($query) {
                $query->whereNull('nilai');
            })
            ->latest()
            ->get();

        foreach ($data['kegiatanPenilaian'] as $formulir) {

            $totalIndikator = 0;
            $terisi = 0;
            foreach ($formulir->domains as $domain) {

                // dd($formulir->id);
                foreach ($domain->aspek as $aspek) {
                    $totalIndikator += $aspek->indikator->count();
                    foreach ($aspek->indikator as $indikator) {
                        // Filter berdasarkan user & formulir yang sedang di-loop
                        if ($indikator->penilaian->where('user_id', Auth::user()->id)->where('formulir_id', $formulir->id)->isNotEmpty()) {
                            $terisi++;
                        }
                    }
                }
            }




            // Tambahkan data ke instance Formulir
            $formulir->total_indikator = $totalIndikator;
            $formulir->indikator_terisi = $terisi;
            $formulir->persentase = $totalIndikator > 0 ? round(($terisi / $totalIndikator) * 100, 2) : 0;

            // dd($formulir->indikator_terisi);
        }


        // dd($formulir);


        return view('dashboard.penilaian.penilaian-index', $data);
    }


    public function penilaianTersedia(Formulir $formulir)
    {
        $totalIndikator = 0;
        $terisi = 0;

        // Load relasi sampai penilaian
        $formulir->load('formulir_domains.domain.aspek.indikator.penilaian');

        foreach ($formulir->formulir_domains as $formulirDomain) {
            $domain = $formulirDomain->domain;

            foreach ($domain->aspek as $aspek) {
                foreach ($aspek->indikator as $indikator) {
                    $totalIndikator++;

                    // Hitung hanya penilaian untuk formulir & user saat ini (jika pakai filter)
                    if ($indikator->penilaian->where('formulir_id', $formulir->id)->where('user_id', Auth::user()->id)->isNotEmpty()) {
                        $terisi++;
                    }
                }
            }
        }

        $persentase = $totalIndikator > 0 ? round(($terisi / $totalIndikator) * 100, 2) : 0;

        return view('dashboard.penilaian.penilaian', compact('formulir', 'persentase', 'totalIndikator', 'terisi'));
    }


    //  public function penilaianTersedia(Formulir $formulir)
    // {
    //     $totalIndikator = 0;
    //     $terisi = 0;

    //     $formulir->load('domains.aspek.indikator');

    //     foreach ($formulir->domains as $domain) {
    //         foreach ($domain->aspek as $aspek) {
    //             $totalIndikator += $aspek->indikator->count();
    //             foreach ($aspek->indikator as $indikator) {

    //                 if ($indikator->penilaian->isNotEmpty()) {
    //                     $terisi++;
    //                 }
    //             }
    //         }
    //     }


    //     // dd($totalIndikator,$terisi);

    //     $persentase = $totalIndikator > 0 ? round(($terisi / $totalIndikator) * 100, 2) : 0;


    //     return view('dashboard.penilaian.penilaian', compact('formulir', 'persentase', 'totalIndikator', 'terisi'));
    // }




    //  formulir/{1}/domain-penilaian

    public function domainPenilaian(Formulir $formulir)
    {
        $formulir->load('domains.aspek.indikator');

        // dd($formulir);
        return view('dashboard.penilaian.domain-penilaian', compact('formulir'));
    }



    public function isiDomain(Formulir $formulir, $nama_domain)
    {


        $domain = Domain::where('nama_domain', $nama_domain)->first();
        $formulir->load('formulir_domains.domain.aspek.indikator.penilaian');
        return view('dashboard.penilaian.isi-domain-aspek-penilaian', compact(['formulir', 'domain']));
    }


    public function penilaianAspek(Formulir $formulir, $nama_domain, $aspek, $req_indikator)
    {


        $domain = Domain::where('nama_domain', $nama_domain)->first();


        // dd($req_indikator);
        $aspek = Aspek::where('domain_id', $domain->id)->where('nama_aspek', $aspek)->first();
        $indikator = Indikator::with('penilaian')->where('aspek_id', $aspek->id)->where('nama_indikator', $req_indikator)->first();
        $formulir->load('domains.aspek.indikator');





        $dinilai = Indikator::with('penilaian')->whereHas('penilaian', function ($query) use ($indikator, $formulir) {
            $query->where('user_id', Auth::user()->id)->where('nilai', '!=', null)->where('indikator_id', $indikator->id)->whereFormulirId($formulir->id);
        })
            ->where('nama_indikator', $req_indikator)->first();



        // dd($indikator->id);
        $next_indikator = Indikator::with('penilaian')->where('id', '>', $indikator->id)->first();
        $prev_indikator = Indikator::with('penilaian')->where('id', '<', $indikator->id)->first();


        // dd($next_indikator, $prev_indikator);
        return view('dashboard.penilaian.sesi-penilaian', compact('formulir', 'domain', 'aspek', 'indikator', 'dinilai', 'next_indikator', 'prev_indikator'));
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

    // public function prev_indikator(Formulir $formulir, $nama_domain, $aspek, $indikator)
    // {
    //     $domain = Domain::where('nama_domain', $nama_domain)->first();
    //     $aspek = Aspek::where('domain_id', $domain->id)->where('nama_aspek', $aspek)->first();
    //     $indikator = Indikator::where('aspek_id', $aspek->id)->where('nama_indikator', $indikator)->first();
    //     return redirect()->route('formulir.penilaianAspek', [$formulir, $domain, $aspek]);
    // }

}
