<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FileDokumentasi;
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
        return view('dashboard.dokumentasi.dokumentasi-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // dd($request->all());
        // $request->validate([
        //     'nama_dokumentasi' => 'required',
        //     'bukti_dukung_undangan' => 'required|mimes:pdf',
        //     'daftar_hadir' => 'required|mimes:pdf',
        //     'materi' => 'required|mimes:pdf',
        //     'notula' => 'required|mimes:pdf',
        //     'files' => 'nullable|array',
        //     'files.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mp3,avi,flv',
        // ], [
        //     'nama_dokumentasi.required' => 'Nama Dokumentasi harus diisi',
        //     'bukti_dukung_undangan.required' => 'Bukti Dukung harus diisi',
        //     'bukti_dukung_undangan.mimes' => 'Bukti Dukung harus PDF',
        //     'daftar_hadir.required' => 'Daftar Hadir harus diisi',
        //     'daftar_hadir.mimes' => 'Daftar Hadir harus PDF',
        //     'materi.required' => 'Materi harus diisi',
        //     'materi.mimes' => 'Materi harus PDF',
        //     'notula.required' => 'Notula harus diisi',
        //     'notula.mimes' => 'Notula harus PDF',
        //     'files.*.required' => 'File harus diisi',
        //     'files.*.mimes' => 'File harus berupa gambar atau video',
        // ]);


        $judul = Str::slug($request->judul_dokumentasi);
        // dd($judul);
        $data = [];
        $data['judul_dokumentasi'] = $request->judul_dokumentasi;

        // Daftar field file tunggal sesuai model
        $fileFields = [
            'bukti_dukung_undangan',
            'daftar_hadir',
            'materi',
            'notula',
        ];

        foreach ($fileFields as $field) {
            $file = $request->file($field);
            if ($file) {
                // Misal: simpan ke storage/app/dokumentasi/

                $filename = $file->getClientOriginalName();
                $filSaved = $field . '-' . $request->judul_dokumentasi . '-' . time() . '.' . $file->getClientOriginalExtension();

                // dd($filSaved);
                $path = $file->storeAs('foto-dokumentasi/' . $judul, $filSaved);
                $data[$field] = $path;
            } else {
                $data[$field] = null;
            }
        }

        // Simpan ke model
        $kegiatan = DokumentasiKegiatan::create([
            'judul_dokumentasi' => $request->judul_dokumentasi,
            'bukti_dukung_undangan' => $data['bukti_dukung_undangan'],
            'daftar_hadir' => $data['daftar_hadir'],
            'materi' => $data['materi'],
            'notula' => $data['notula'],
        ]);

        // Kalau ada files[] tambahan (bukti tambahan), bisa ditangani terpisah
        $files = $request->file('files');
        if ($files && is_array($files)) {
            foreach ($files as $index => $file) {
                if ($file) {
                    $filename = $file->getClientOriginalName();
                    $filSaved = 'media -' . $index . '-' . $request->judul_dokumentasi . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $fileext = $file->getClientOriginalExtension();
                    $path = $file->storeAs('foto-dokumentasi/' . $judul, $filename);

                    // Contoh simpan ke tabel terpisah dengan relasi
                    $kegiatan->file_dokumentasi()->create([
                        'nama_file' => 'foto-dokumentasi/'.$judul.'/'. $filSaved,
                        'tipe_file' => $fileext,
                        'dokumentasi_id' => $kegiatan->id
                    ]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Formulir $formulir)
    {
        $totalIndikator = 0;
        $terisi = 0;

        // Load relasi sampai penilaian
        $formulir->load(['formulir_domains.domain.aspek.indikator.penilaian', 'dokumentasi']);

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
        return view('dashboard.dokumentasi.dokumentasi-show', compact('formulir', 'persentase', 'totalIndikator', 'terisi'));
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
