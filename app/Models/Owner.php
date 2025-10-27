<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
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

   
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
