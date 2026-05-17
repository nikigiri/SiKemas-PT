<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanDesain extends Model
{
    use HasFactory;

    protected $fillable = [
        'desain_id',
        'ukuran_font',
        'jarak_elemen',
    ];

    // Relasi ke Desain
    public function desain()
    {
        return $this->belongsTo(Desain::class);
    }
}