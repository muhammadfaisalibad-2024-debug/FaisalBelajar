<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use SoftDeletesWithUser;
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;
    
    protected $fillable = [
        'iduser',
        'idrole',
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'idrole_user';
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    // Relasi ke Temu Dokter
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user', 'idrole_user');
    }
}
