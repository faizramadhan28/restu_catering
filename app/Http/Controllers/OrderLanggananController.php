<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\OrderLangganan;
use App\Models\CartLangganan;
use App\Models\Delivery;
use App\Models\Langganan;
use App\Models\Payment;
use App\Models\Status;

class OrderLanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ordersubs.index', [
            'title' => 'Daftar Pesanan Langganan',
            'ordersubs' => OrderLangganan::all(),
            'statuses' => Status::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $langganans = Langganan::all();

        $validated = $request->validate([
            'fullname' => 'required',
            'telp' => 'required',
            'address' => 'required',
            'time_awal' => 'required',
            'time_akhir' => 'required',
            'type_pembayaran' => 'required',
            'type_pengiriman' => 'required',
            'date_awal' => 'required|date',
            'date_akhir' => 'required|date'
        ], [
            'fullname.required' => ':attribute tidak boleh kosong',
            'telp.required' => ':attribute telah digunakan',
            'address.required' => ':attribute tidak boleh kosong',
            'time_awal.required' => ':attribute harus angka',
            'time_akhir.required' => ':attribute harus angka',
            'type_pembayaran.required' => ':attribute tidak boleh kosong',
            'type_pengiriman.required' => ':attribute tidak boleh kosong',
            'date_awal.required' => ':attribute tidak boleh kosong1',
            'date_akhir.required' => ':attribute tidak boleh kosong2'
        ]);

        $cart = [];
        $total = 0;

        foreach (CartLangganan::where('user_id', Auth::id())->get() as $value) {
            $total += Langganan::find($value->langganan_id)->harga * $value->qty;
            $cart[] = [
                'langganan_id' => $value->langganan_id,
                'qty' => $value->qty
            ];
            CartLangganan::destroy($value->id);
        }



        $payment = Payment::where('inisial', $validated['type_pembayaran'])->first();
        $delivery = Delivery::where('inisial', $validated['type_pengiriman'])->first();

        if ($payment && $delivery) {
            $orderId = preg_replace('/[\s]/', "$validated[type_pembayaran]", preg_replace('/[-:].*/', '', Carbon::now()->toDateTimeString())) . strtoupper(explode('-', Str::uuid())[0]);

            OrderLangganan::create([
                'id' => $orderId,
                'user_id' => Auth::id(),
                'nama_penerima' => $validated['fullname'],
                'telp_penerima' => $validated['telp'],
                'alamat_penerima' => $validated['address'],
                'waktu_kirim' => Carbon::createFromFormat('Y-m-d H:i', "$validated[date_awal] $validated[time_awal]"),
                'waktu_berakhir' => Carbon::createFromFormat('Y-m-d H:i', "$validated[date_akhir] $validated[time_akhir]"),
                'pesanan' => json_encode($cart),
                'type_pembayaran' => $validated['type_pembayaran'],
                'type_pengiriman' => $validated['type_pengiriman'],
                'kadaluarsa' => Carbon::now('Asia/Jakarta')->subDays(-1),
                'status' => 'unpaid',

            ]);

            if ($validated['type_pembayaran'] != 'COD') {
                return view('checkout-subs.payment', [
                    'total' => $total,
                    'payment' => $payment,
                    'orderId' => $orderId
                ]);
            } else {
                return redirect()->route('home.order');
            }
        } else {
            return abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = OrderLangganan::find($id);

        if (!$order) {
            return abort(404);
        }

        $lists = [];
        $total = 0;

        foreach (json_decode($order->pesanan) as $pesanan) {
            $menu = Langganan::find($pesanan->langganan_id);
            $total += $menu->harga * $pesanan->qty;
            $lists[] = (object) [
                'menu' => $menu,
                'qty' => $pesanan->qty
            ];
        }

        return view('dashboard.ordersubs.detail', [
            'title' => 'Detail Orderan',
            'id' => $order->id,
            'user_id' => $order->user_id,
            'nama_penerima' => $order->nama_penerima,
            'telp_penerima' => $order->telp_penerima,
            'alamat_penerima' => $order->alamat_penerima,
            'waktu_kirim' => $order->waktu_kirim,
            'waktu_berakhir' => $order->waktu_berakhir,
            'pesanan' => json_decode($order->pesanan, true),
            'type_pembayaran' => Payment::where('inisial', $order->type_pembayaran)->first(),
            'type_pengiriman' => Delivery::where('inisial', $order->type_pengiriman)->first(),
            'kadaluarsa' => $order->kadaluarsa,
            'bukti_pembayaran' => $order->bukti_pembayaran,
            'statuses' => Status::all(),
            'status' => Status::where('inisial', $order->status)->first(),
            'created_at' => $order->created_at,
            'total' => $total,
            'lists' => $lists
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = $request->all();
        $order['id'] = $id;

        OrderLangganan::where('id', $id)->update([
            'status' => $order['status']
        ]);

        $request->session()->flash('status', "Status Berhasil Di Rubah");
        return redirect()->route('ordersubs.detail', $id);
    }

    public function updateBuktiBayar(Request $request, $id)
    {
        $order = $request->all();
        $order['id'] = $id;

        $validated = Validator::make($order, [
            'imageBukti' => 'required|mimes:jpg,png,jpeg|max:2048'
        ], [
            'imageBukti.required' => 'upload bukti bayar gagal',
            'imageBukti.mimes' => 'image harus berupa jpg, png, atau jpeg',
            'imageBukti.max' => 'image size maximal 2MB',
        ]);

        if ($validated->fails()) return redirect()->route('subs.order.detail', $id)->withErrors($validated)->withInput();

        OrderLangganan::where('id', $id)->update([
            'bukti_pembayaran' => Str::replace('public/struct/', '', $request->file('imageBukti')->store('public/struct'))
        ]);

        $request->session()->flash('status', "Bukti Bayar Berhasil Di Upload");
        return redirect()->route('subs.order.detail', $id);
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
            'id' => 'required|exists:orders,id|max:255'
        ], [
            'id.exists' => 'Orderan tidak di temukan.'
        ]);

        if ($validated->fails()) return redirect()->route('subs.order')->withErrors($validated)->withInput();

        $order = OrderLangganan::find($id);
        if ($order->bukti_pembayaran) {
            Storage::delete("public/struct/$order->bukti_pembayaran");
        }

        OrderLangganan::destroy($id);
        $request->session()->flash('status', "Orderan Berhasil Di Hapus");
        return redirect()->route('subs.order');
    }
}
