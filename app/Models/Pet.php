<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pet extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'pet';
    protected $primaryKey = 'idpet';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idpet';
    }

    /**
     * Get the owner of the pet.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'idpemilik', 'idpemilik');
    }

    /**
     * Get the breed of the pet.
     */
    public function animalBreed(): BelongsTo
    {
        return $this->belongsTo(AnimalBreed::class, 'idras_hewan', 'idras_hewan');
    }

    /**
     * Get the animal type through breed.
     */
    public function animalType()
    {
        return $this->hasOneThrough(
            AnimalType::class,
            AnimalBreed::class,
            'idras_hewan', // FK on animal_breeds table
            'idjenis_hewan', // FK on animal_types table
            'idras_hewan', // Local key on pets table
            'idjenis_hewan' // Local key on animal_breeds table
        );
    }

    /**
     * Get the pet's age.
     */
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_lahir ? $this->tanggal_lahir->age : null,
        );
    }
}
