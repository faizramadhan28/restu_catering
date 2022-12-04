<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langganan extends Model
{
    use HasFactory;

    public $table = 'langganan';

    protected $fillable = [
        'menu',
        'harga',
        'desc',
        'durasi',
        'image'
    ];
}