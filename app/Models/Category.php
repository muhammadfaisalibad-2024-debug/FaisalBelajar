<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false; 

    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';

    protected $fillable = [
        'nama_kategori',
    ];

    
    public function getRouteKeyName(): string
    {
        return 'idkategori';
    }


    public function therapyActionCodes(): HasMany
    {
        return $this->hasMany(TherapyActionCode::class, 'idkategori', 'idkategori');
    }
}
