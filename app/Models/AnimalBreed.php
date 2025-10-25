<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalBreed extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';

    protected $fillable = [
        'nama_ras',
        'idjenis_hewan',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idras_hewan';
    }

    /**
     * Get the animal type that owns this breed.
     */
    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    /**
     * Get the pets of this breed.
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'idras_hewan', 'idras_hewan');
    }
}
