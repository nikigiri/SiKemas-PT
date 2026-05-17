<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilEkspor extends Model
{
    use HasFactory;

    protected $fillable = [
        'desain_id',
        'format_file',
        'resolusi',
        'file_path',
        'tgl_ekspor',
    ];

    // Relasi ke Desain
    public function desain()
    {
        return $this->belongsTo(Desain::class);
    }
}