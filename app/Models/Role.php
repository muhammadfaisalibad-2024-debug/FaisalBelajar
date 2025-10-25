<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'role';
    protected $primaryKey = 'idrole';

    protected $fillable = [
        'nama_role',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'idrole';
    }

    /**
     * Get the users that have this role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser')
                    ->withPivot('status');
    }
}
