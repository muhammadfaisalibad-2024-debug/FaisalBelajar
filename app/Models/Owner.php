<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';

    protected $fillable = [
        'no_wa',
        'alamat',
        'iduser',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idpemilik';
    }

    /**
     * Get the pets owned by this owner.
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }

    /**
     * Get the user of this owner.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
