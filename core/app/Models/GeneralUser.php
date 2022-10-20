<?php

namespace App\Models;
use App\Models\VerifyUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class GeneralUser extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'general_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'last_name',
        'phone',
        'verified_code',
        'country',
        'email',
        'password',
        'photo',
        'user_name',
        'follower',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function votes(){
        return $this->belongsToMany(AdminVote::class,'user_vote','user_id','vote_id');
    }
    public function book()
    {
        return $this->morphOne(Book::class, 'bookable');
    }


}
