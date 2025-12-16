<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Owner extends Model
{
    use SoftDeletesWithUser;
    public $timestamps = false;

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';

    protected $fillable = [
        'no_wa',
        'alamat',
        'iduser',
    ];

    public function getRouteKeyName(): string
    {
        return 'idpemilik';
    }

    // Accessor untuk nama (dari relasi user)
    protected function nama(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user?->nama ?? '-',
        );
    }

    // Accessor untuk no_telp (alias dari no_wa)
    protected function noTelp(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->no_wa ?? '-',
        );
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
