<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use SoftDeletesWithUser;
    public $timestamps = false;

    protected $table = 'role';
    protected $primaryKey = 'idrole';

    protected $fillable = [
        'nama_role',
    ];

  
    public function getRouteKeyName(): string
    {
        return 'idrole';
    }

    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser')
                    ->withPivot('status');
    }
}
