<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClinicalCategory extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';

    protected $fillable = [
        'nama_kategori_klinis',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idkategori_klinis';
    }

    /**
     * Get the therapy action codes in this category.
     */
    public function therapyActionCodes(): HasMany
    {
        return $this->hasMany(TherapyActionCode::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
