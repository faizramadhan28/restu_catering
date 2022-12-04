<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\Langganan;
use App\Models\Cart;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.langganan.index', [
            'title' => 'Daftar Menu Langganan',
            'langganan' => Langganan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.langganan.create', [
            'title' => 'Tambah Menu Langganan',
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
            'menu' => 'required|unique:menus,menu|max:255',
            'desc' => 'required',
            'durasi' => 'required',
            'harga' => 'required|integer',
            'imageLangganan' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'menu.required' => ':attribute tidak boleh kosong',
            'menu.unique' => ':attribute telah digunakan',
            'harga.required' => ':attribute tidak boleh kosong',
            'durasi.required' => ':attribute tidak boleh kosong',
            'harga.integer' => ':attribute harus angka',
            'desc.required' => ':attribute tidak boleh kosong',
            'imageLangganan.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageLangganan.max' => 'image size maximal 2MB',
        ]);

        Langganan::create([
            'menu' => $validated['menu'],
            'harga' => $validated['harga'],
            'desc' => $validated['desc'],
            'durasi' => $validated['durasi'],
            'image' => Str::replace('public/img/', '', $request->file('imageLangganan')->store('public/img'))
        ]);

        $request->session()->flash('status', "Menu Langganan $validated[menu] Berhasil Di Tambahkan");
        return redirect()->route('langganan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('menu.details', [
            'menu' => Menu::find($id),
            'menus' => Menu::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $langganan = Langganan::find($id);
        if (!$langganan) return abort(404);

        return view('dashboard.langganan.update', [
            'title' => 'Edit Menu Langganan',
            'langganan' => $langganan
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
        $langganan = $request->all();
        $langganan['id'] = $id;
        $validated = Validator::make($langganan, [
            'id' => 'required|exists:menus,id|max:255',
            'menu' => "required|unique:menus,menu,$id|max:255",
            'desc' => 'required',
            'durasi' => 'required',
            'harga' => 'required|integer',
            'imageLangganan' => 'mimes:jpg,png,jpeg|max:2048'
        ], [
            'id.exists' => 'Hmmmm.',
            'menu.required' => ':attribute tidak boleh kosong.',
            'menu.unique' => ':attribute sudah di gunakan.',
            'harga.required' => ':attribute tidak boleh kosong.',
            'durasi.required' => ':attribute tidak boleh kosong.',
            'harga.integer' => ':attribute harus angka.',
            'desc.required' => ':attribute tidak boleh kosong.',
            'imageLangganan.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageLangganan.max' => 'image size maximal 2MB',
        ]);

        if ($validated->fails()) return redirect()->route('langganan.edit', $id)->withErrors($validated)->withInput();

        $chunk = [
            'menu' => $langganan['menu'],
            'harga' => $langganan['harga'],
            'desc' => $langganan['desc'],
            'durasi' => $langganan['durasi']
        ];

        if (Arr::exists($langganan, 'imageLangganan')) {
            Storage::delete("public/img/" . Langganan::find($id)->image);
            $chunk['image'] = Str::replace('public/img/', '', $langganan['imageLangganan']->store('public/img'));
        }

        Langganan::where('id', $id)->update($chunk);
        $request->session()->flash('status', "Menu $langganan[menu] Berhasil Di Update");
        return redirect()->route('langganan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|exists:menus,id|max:255'
        ], [
            'id.exists' => 'Menu Olahan tidak di temukan.'
        ]);

        if ($validated->fails()) return redirect()->route('langganan.index', $id)->withErrors($validated)->withInput();

        $langganan = Langganan::find($id);
        Storage::delete("public/img/$langganan->image");

        Langganan::destroy($id);
        $request->session()->flash('status', "Menu Langganan Berhasil Di Hapus");
        return redirect()->route('langganan.index');
    }
}
