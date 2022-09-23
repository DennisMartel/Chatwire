<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function socialProfiles()
    {
        return $this->hasMany(SocialProfile::class);
    }

    // Este metodo me retorna mi lista de amigos
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->wherePivot('accepted', true);    
    }

    // Este metodo me retorna las personas del cual soy amigo
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->wherePivot('accepted', true);
    }

    // Este metodo me retorna todas la personas que tengo agregada a mi lista de amigos 
    // y tambien de las personas del cual soy amigo cuando la solicitud ha sido aceptada
    public function friends()
    {
        return $this->friendsOfMine()->get()->merge($this->friendOf()->get());
    }

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes()->where('user_id', $this->id)->count();
    }
}
