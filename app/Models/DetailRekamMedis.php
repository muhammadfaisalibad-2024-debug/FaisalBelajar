<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRekamMedis extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    public $timestamps = false;
    
    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'detail'
    ];

    public function getRouteKeyName()
    {
        return 'iddetail_rekam_medis';
    }

    // Relasi ke Rekam Medis
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Relasi ke Kode Tindakan Terapi
    public function kodeTindakan()
    {
        return $this->belongsTo(TherapyActionCode::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}
