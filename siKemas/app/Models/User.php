<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'nama_usaha', 'email', 'no_tlp', 'alamat_usaha', 'password', 'kwt_id', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // Relasi ke Produk
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    public function kwt()
    {
        return $this->belongsTo(Kwt::class);
    }

    public function desains()
{
    return $this->hasManyThrough(
        \App\Models\Desain::class,
        \App\Models\Produk::class,
        'user_id',  
        'produk_id', 
    );
}

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}