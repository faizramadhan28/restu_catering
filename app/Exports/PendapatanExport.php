<?php

namespace App\Exports;

use App\Models\Delivery;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PendapatanExport implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        $orders = [];
        $allTotal = 0;

        foreach (Order::all() as $order) {
            $lists = [];
            $total = 0;

            foreach (json_decode($order->pesanan) as $pesanan) {
                $menu = Menu::find($pesanan->menu_id);
                $total += $menu->harga * $pesanan->qty;
                $lists[] = (object) [
                    'menu' => $menu,
                    'qty' => $pesanan->qty
                ];
            }

            $allTotal += $total;

            $orders[] = (object) [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'nama_penerima' => $order->nama_penerima,
                'telp_penerima' => $order->telp_penerima,
                'alamat_penerima' => $order->alamat_penerima,
                'waktu_kirim' => $order->waktu_kirim,
                'pesanan' => json_decode($order->pesanan, true),
                'type_pembayaran' => Payment::where('inisial', $order->type_pembayaran)->first(),
                'type_pengiriman' => Delivery::where('inisial', $order->type_pengiriman)->first(),
                'kadaluarsa' => $order->kadaluarsa,
                'bukti_pembayaran' => $order->bukti_pembayaran,
                'status' => Status::where('inisial', $order->status)->first(),
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->toDateString(),
                'total' => $total,
                'lists' => $lists
            ];
        }
        return view('excel.pendapatan', [
            'orders' => $orders,
            'statuses' => Status::all(),
            'allTotal' => $allTotal
        ]);
    }
}