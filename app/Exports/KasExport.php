<?php

namespace App\Exports;

use App\Models\Kas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class KasExport implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        return view('excel.index', [
            'kas' => Kas::all()
        ]);
    }
}