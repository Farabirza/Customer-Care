<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluhanStatusHis extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function complain()
    {
        return $this->belongsTo(KeluhanPelanggan::class, 'keluhan_id');
    }
}
