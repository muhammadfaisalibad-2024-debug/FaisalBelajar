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

    public function getRouteKeyName(): string
    {
        return 'idkode_tindakan_terapi';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'idkategori', 'idkategori');
    }
    
    public function clinicalCategory(): BelongsTo
    {
        return $this->belongsTo(ClinicalCategory::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
