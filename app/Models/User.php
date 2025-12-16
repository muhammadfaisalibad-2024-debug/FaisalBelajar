<?php

namespace App\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  
    use HasFactory, Notifiable, SoftDeletesWithUser;

    public $timestamps = false; // Disable timestamps untuk tabel native

    protected $table = 'user';
    protected $primaryKey = 'iduser';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

   
    public function getRouteKeyName(): string
    {
        return 'iduser';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole');
    }

    
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('nama_role', $role)->exists();
    }

    
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('nama_role', $roles)->exists();
    }
}
