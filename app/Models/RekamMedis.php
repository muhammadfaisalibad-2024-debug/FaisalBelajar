<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;
    
    protected $fillable = [
        'created_at',
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'dokter_pemeriksa',
        'idreservasi_dokter'
    ];

    public function getRouteKeyName()
    {
        return 'idrekam_medis';
    }

    // Relasi ke RoleUser (Dokter yang memeriksa)
    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    // Relasi ke Temu Dokter (Reservasi)
    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    // Relasi ke Pet melalui Temu Dokter
    public function pet()
    {
        return $this->hasOneThrough(
            Pet::class,
            TemuDokter::class,
            'idreservasi_dokter', // FK on temu_dokter table
            'idpet', // FK on pet table
            'idreservasi_dokter', // Local key on rekam_medis table
            'idpet' // Local key on temu_dokter table
        );
    }

    // Relasi ke Detail Rekam Medis
    public function details()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}
