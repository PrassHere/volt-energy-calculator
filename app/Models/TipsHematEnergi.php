<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipsHematEnergi extends Model
{
    use HasFactory;

    protected $table = 'tips_hemat_energis';
    protected $primaryKey = 'id_tips';

    protected $fillable = [
        'judul_tips',
        'konten',
        'kategori',
        'penghematan',
        'icon',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }
}
