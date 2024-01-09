<?php

namespace App\Exports;

use App\Models\KeluhanPelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeluhanPelangganExport implements FromCollection
{
    public function collection()
    {
        return KeluhanPelanggan::all();
    }
}
