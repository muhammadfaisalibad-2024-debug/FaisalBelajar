<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalBreed extends Model
{
    use SoftDeletesWithUser;
    public $timestamps = false; 

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';

    protected $fillable = [
        'nama_ras',
        'idjenis_hewan',
    ];

   
    public function getRouteKeyName(): string
    {
        return 'idras_hewan';
    }

   
    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class, 'idjenis_hewan', 'idjenis_hewan');
    }

   
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'idras_hewan', 'idras_hewan');
    }
}
