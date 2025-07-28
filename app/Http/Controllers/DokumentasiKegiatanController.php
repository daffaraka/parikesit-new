<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FileDokumentasi;
use App\Models\DokumentasiKegiatan;
use Illuminate\Support\Facades\Auth;

class DokumentasiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumentasis = DokumentasiKegiatan::with('file_dokumentasi')->latest()->get();

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

        $request->validate([
            'judul_dokumentasi' => 'required',
            'bukti_dukung_undangan' => 'required|mimes:pdf|max:5120',
            'daftar_hadir' => 'required|mimes:pdf|max:5120',
            'materi' => 'required|mimes:pdf|max:5120',
            'notula' => 'required|mimes:pdf|max:5120',
            'files' => 'nullable|array',
            'files.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mp3,avi,flv|max:5120',
        ], [
            'judul_dokumentasi.required' => 'Nama Dokumentasi harus diisi',
            'bukti_dukung_undangan.required' => 'Bukti Dukung harus diisi',
            'bukti_dukung_undangan.mimes' => 'Bukti Dukung harus PDF',
            'bukti_dukung_undangan.max' => 'Bukti Dukung maximal 5mb',
            'daftar_hadir.required' => 'Daftar Hadir harus diisi',
            'daftar_hadir.mimes' => 'Daftar Hadir harus PDF',
            'daftar_hadir.max' => 'Daftar Hadir maximal 5mb',
            'materi.required' => 'Materi harus diisi',
            'materi.mimes' => 'Materi harus PDF',
            'materi.max' => 'Materi maximal 5mb',
            'notula.required' => 'Notula harus diisi',
            'notula.mimes' => 'Notula harus PDF',
            'notula.max' => 'Notula maximal 5mb',
            'files.*.required' => 'File harus diisi',
            'files.*.mimes' => 'File harus berupa gambar atau video',
            'files.*.max' => 'File maximal 5mb',
        ]);


        $judul = Str::slug($request->judul_dokumentasi.'-'.time());
        $path = 'file-dokumentasi/'.$judul;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

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
                
                $path = $file->move('file-dokumentasi/' . $judul.'/.', $filSaved);

             
                $data[$field] = $path;
            } else {
                $data[$field] = null;
            }
        }

        // dd($data);
        // Simpan ke model
        $kegiatan = DokumentasiKegiatan::create([
            'created_by_id' => Auth::user()->id,
            'judul_dokumentasi' => $request->judul_dokumentasi,
            'bukti_dukung_undangan_dokumentasi' => $data['bukti_dukung_undangan'],
            'daftar_hadir_dokumentasi' => $data['daftar_hadir'],
            'materi_dokumentasi' => $data['materi'],
            'notula_dokumentasi' => $data['notula'],
        ]);

        // Kalau ada files[] tambahan (bukti tambahan), bisa ditangani terpisah
        $files = $request->file('files');
        if ($files && is_array($files)) {
            foreach ($files as $index => $file) {
                if ($file) {
                    $filename = $file->getClientOriginalName();
                    $filSaved = 'media-' . $index . '-' . $request->judul_dokumentasi . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $fileext = $file->getClientOriginalExtension();
                    $path = $file->move('file-dokumentasi/' . $judul . '/media', $filSaved);


                    // dd($path);
                    // Contoh simpan ke tabel terpisah dengan relasi
                    $kegiatan->file_dokumentasi()->create([
                        'nama_file' => 'file-dokumentasi/' . $judul . '/media/' . $filSaved,
                        'tipe_file' => $fileext,
                        'dokumentasi_id' => $kegiatan->id
                    ]);
                }
            }
        }


        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dibuat');
    }
    /**
     * Display the specified resource.
     */
    public function show(DokumentasiKegiatan $dokumentasiKegiatan)
    {


        $dokumentasiKegiatan->load('file_dokumentasi');

        // dd($dokumentasiKegiatan);
        return view('dashboard.dokumentasi.dokumentasi-show', compact('dokumentasiKegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DokumentasiKegiatan $dokumentasiKegiatan)
    {
        $dokumentasiKegiatan->load('file_dokumentasi');
        return view('dashboard.dokumentasi.dokumentasi-edit',compact('dokumentasiKegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DokumentasiKegiatan $dokumentasiKegiatan)
    {
          $request->validate([
            'judul_dokumentasi' => 'required',
            'bukti_dukung_undangan' => 'required|mimes:pdf|max:5120',
            'daftar_hadir' => 'required|mimes:pdf|max:5120',
            'materi' => 'required|mimes:pdf|max:5120',
            'notula' => 'required|mimes:pdf|max:5120',
            'files' => 'nullable|array',
            'files.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mp3,avi,flv|max:5120',
        ], [
            'judul_dokumentasi.required' => 'Nama Dokumentasi harus diisi',
            'bukti_dukung_undangan.required' => 'Bukti Dukung harus diisi',
            'bukti_dukung_undangan.mimes' => 'Bukti Dukung harus PDF',
            'bukti_dukung_undangan.max' => 'Bukti Dukung maximal 5mb',
            'daftar_hadir.required' => 'Daftar Hadir harus diisi',
            'daftar_hadir.mimes' => 'Daftar Hadir harus PDF',
            'daftar_hadir.max' => 'Daftar Hadir maximal 5mb',
            'materi.required' => 'Materi harus diisi',
            'materi.mimes' => 'Materi harus PDF',
            'materi.max' => 'Materi maximal 5mb',
            'notula.required' => 'Notula harus diisi',
            'notula.mimes' => 'Notula harus PDF',
            'notula.max' => 'Notula maximal 5mb',
            'files.*.required' => 'File harus diisi',
            'files.*.mimes' => 'File harus berupa gambar atau video',
            'files.*.max' => 'File maximal 5mb',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DokumentasiKegiatan $dokumentasiKegiatan)
    {
       $dokumentasiKegiatan->delete();

       return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus');
    }
}
