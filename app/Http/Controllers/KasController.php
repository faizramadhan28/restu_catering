<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\Kas;
use App\Exports\KasExport;
use Maatwebsite\Excel\Facades\Excel;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kaskeluar.index', [
            'title' => 'Laporan Kas Keluar',
            'kas' => Kas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kaskeluar.create', [
            'title' => 'Tambah Kas Keluar',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_transaksi' => 'required|max:255',
            'tgl_transaksi' => 'required',
            'uang_keluar' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'nama_transaksi.required' => ':attribute tidak boleh kosong',
            'tgl_transaksi.required' => ':attribute tidak boleh kosong',
            'uang_keluar.required' => ':attribute tidak boleh kosong',
            'foto.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'foto.max' => 'image size maximal 2MB',
        ]);
        

        Kas::create([
            'nama_transaksi' => $validated['nama_transaksi'],
            'tgl_transaksi' => $validated['tgl_transaksi'],
            'uang_keluar' => $validated['uang_keluar'],
            'foto' => Str::replace('public/kas/', '', $request->file('foto')->store('public/kas'))
        ]);

        $request->session()->flash('status', "Kas Dengan Nama $validated[nama_transaksi] Berhasil Di Tambahkan");
        return redirect()->route('kas.index');
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
    public function edit(Request $request, $id)
    {
        $kas = Kas::find($id);
        if (!$kas) return abort(404);

        return view('dashboard.kaskeluar.update', [
            'title' => 'Edit Menu',
            'kas' => $kas
        ]);
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
        $kas = $request->all();
        $kas['id'] = $id;
        $validated = Validator::make($kas, [
            'id' => 'required|exists:kas,id|max:255',
            'nama_transaksi' => 'required|max:255',
            'tgl_transaksi' => 'required',
            'uang_keluar' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'id.exists' => 'Hmmmm.',
            'nama_transaksi.required' => ':attribute tidak boleh kosong',
            'tgl_transaksi.required' => ':attribute tidak boleh kosong',
            'uang_keluar.required' => ':attribute tidak boleh kosong',
            'foto.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'foto.max' => 'image size maximal 2MB',
        ]);

        if ($validated->fails()) return redirect()->route('kas.edit', $id)->withErrors($validated)->withInput();

        $chunk = [
            'nama_transaksi' => $kas['nama_transaksi'],
            'tgl_transaksi' => $kas['tgl_transaksi'],
            'uang_keluar' => $kas['uang_keluar']
        ];

        if (Arr::exists($kas, 'foto')) {
            Storage::delete("public/kas/" . Kas::find($id)->foto);
            $chunk['foto'] = Str::replace('public/kas/', '', $kas['foto']->store('public/kas'));
        }

        Kas::where('id', $id)->update($chunk);
        $request->session()->flash('status', "Kas dengan nama $kas[nama_transaksi] Berhasil Di Update");
        return redirect()->route('kas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $kas = Kas::find($id);
        Storage::delete("public/kas/$kas->foto");

        Kas::destroy($id);
        $request->session()->flash('status', "Kas Pengeluaran Berhasil Di Hapus");
        return redirect()->route('kas.index');
    }

    public function export_excel()
	{
		return Excel::download(new KasExport, 'kas.xlsx');
        return view('kas.index');
	}
}
