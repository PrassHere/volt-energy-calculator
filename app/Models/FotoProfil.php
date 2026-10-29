<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FotoProfil extends Model
{
    protected $table = 'foto_profils';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['email', 'mime', 'data'];

    // Jangan ikut tercetak jika model diubah menjadi array/JSON
    protected $hidden = ['data'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}