<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static find($id)
 * @method static create($data)
 */
final class User extends Authenticatable
{
    use Notifiable;

    /** The attributes that are mass assignable. */
    protected $fillable = ['id', 'name', 'username', 'email'];

    /** The attributes that should be hidden for arrays. */
//    protected $hidden = ['password', 'remember_token'];

    /** The attributes that should be cast to native types. */
//    protected $casts = ['email_verified_at' => 'datetime'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
