<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLangganan extends Model
{
    public $table = 'ordersubs';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'nama_penerima',
        'telp_penerima',
        'alamat_penerima',
        'waktu_kirim',
        'waktu_berakhir',
        'pesanan',
        'durasi',
        'type_pembayaran',
        'type_pengiriman',
        'kadaluarsa',
        'bukti_pembayaran',
        'status'
    ];
}
