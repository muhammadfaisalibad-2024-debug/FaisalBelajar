<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use SoftDeletesWithUser;
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;
    
    protected $fillable = [
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user'
    ];

    protected $casts = [
        'waktu_daftar' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'idreservasi_dokter';
    }

    // Relasi ke Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke Role User (untuk mendapatkan dokter)
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    // Relasi ke User (Dokter) melalui role_user
    public function dokter()
    {
        return $this->hasOneThrough(
            User::class,
            RoleUser::class,
            'idrole_user', // FK on role_user table
            'iduser', // FK on user table
            'idrole_user', // Local key on temu_dokter table
            'iduser' // Local key on role_user table
        );
    }

    // Relasi ke Owner melalui Pet
    public function owner()
    {
        return $this->hasOneThrough(
            Owner::class,
            Pet::class,
            'idpet', // FK on pet table
            'idpemilik', // FK on owner table
            'idpet', // Local key on temu_dokter table
            'idpemilik' // Local key on pet table
        );
    }

    // Relasi ke Rekam Medis
    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
}
