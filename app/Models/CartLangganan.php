<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartLangganan extends Model
{
    public $table = 'cartslangganan';

    protected $fillable = [
        'user_id',
        'langganan_id',
        'qty'
    ];
}
