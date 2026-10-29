<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Email dipakai sebagai primary key (sesuai migration)
    protected $table = 'users';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['email', 'nama', 'password', 'foto_versi'];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', // otomatis di-hash saat disimpan
        ];
    }

    // Tabel users tidak punya kolom remember_token
    public function getRememberTokenName()
    {
        return '';
    }

    // ---------- Relasi ----------

    // Data foto disimpan di tabel foto_profils
    public function fotoProfil()
    {
        return $this->hasOne(FotoProfil::class, 'email', 'email');
    }

    public function perangkats()
    {
        return $this->hasMany(Perangkat::class, 'email', 'email');
    }

    public function hasilKalkulasis()
    {
        return $this->hasMany(HasilKalkulasi::class, 'email', 'email');
    }

    // ---------- Accessor ----------

    // $user->foto_url : alamat gambar foto, atau null jika belum punya foto
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto_versi
            ? route('profil.foto', ['v' => $this->foto_versi])
            : null;
    }

    // $user->inisial : huruf pertama nama (dipakai jika belum punya foto)
    public function getInisialAttribute(): string
    {
        return strtoupper(mb_substr($this->nama, 0, 1));
    }
}