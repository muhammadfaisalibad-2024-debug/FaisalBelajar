<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalType extends Model
{
    use SoftDeletesWithUser;
    public $timestamps = false;

    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';

    protected $fillable = [
        'nama_jenis_hewan',
    ];

   
    public function getRouteKeyName(): string
    {
        return 'idjenis_hewan';
    }

  
    public function breeds(): HasMany
    {
        return $this->hasMany(AnimalBreed::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    public function pets()
    {
        return $this->hasManyThrough(
            Pet::class,
            AnimalBreed::class,
            'idjenis_hewan', 
            'idras_hewan', 
            'idjenis_hewan', 
            'idras_hewan' 
        );
    }
}
