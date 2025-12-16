<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pet extends Model
{
    use SoftDeletesWithUser;
    public $timestamps = false; 

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

   
    public function getRouteKeyName(): string
    {
        return 'idpet';
    }

    
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'idpemilik', 'idpemilik');
    }

   
    public function animalBreed(): BelongsTo
    {
        return $this->belongsTo(AnimalBreed::class, 'idras_hewan', 'idras_hewan');
    }

   
    public function animalType()
    {
        return $this->hasOneThrough(
            AnimalType::class,
            AnimalBreed::class,
            'idras_hewan', 
            'idjenis_hewan', 
            'idras_hewan', 
            'idjenis_hewan' 
        );
    }

    
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_lahir ? $this->tanggal_lahir->age : null,
        );
    }
}
