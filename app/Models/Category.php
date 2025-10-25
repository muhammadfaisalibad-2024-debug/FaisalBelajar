<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';

    protected $fillable = [
        'nama_kategori',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idkategori';
    }

    /**
     * Get the therapy action codes for this category.
     */
    public function therapyActionCodes(): HasMany
    {
        return $this->hasMany(TherapyActionCode::class, 'idkategori', 'idkategori');
    }
}
