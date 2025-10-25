<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TherapyActionCode extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';

    protected $fillable = [
        'kode',
        'deskripsi_tindakan_terapi',
        'idkategori',
        'idkategori_klinis',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idkode_tindakan_terapi';
    }

    /**
     * Get the category of this therapy action code.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'idkategori', 'idkategori');
    }

    /**
     * Get the clinical category of this therapy action code.
     */
    public function clinicalCategory(): BelongsTo
    {
        return $this->belongsTo(ClinicalCategory::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
