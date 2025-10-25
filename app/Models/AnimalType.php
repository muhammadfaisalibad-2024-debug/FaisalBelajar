<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalType extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';

    protected $fillable = [
        'nama_jenis_hewan',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idjenis_hewan';
    }

    /**
     * Get the breeds for this animal type.
     */
    public function breeds(): HasMany
    {
        return $this->hasMany(AnimalBreed::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    /**
     * Get the pets of this animal type through breeds.
     */
    public function pets()
    {
        return $this->hasManyThrough(
            Pet::class,
            AnimalBreed::class,
            'idjenis_hewan', // FK on animal_breeds table
            'idras_hewan', // FK on pets table
            'idjenis_hewan', // Local key on animal_types table
            'idras_hewan' // Local key on animal_breeds table
        );
    }
}
