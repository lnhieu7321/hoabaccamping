<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'statuses_id ',
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
        'password' => 'hashed',
    ];

    public function businesses()
    {
        return $this->hasOne(Business::class, 'users_id');
    }
    public function customers()
    {
        return $this->hasOne(Customer::class, 'users_id');
    }

    public function user_statuses()
    {

        return $this->belongsTo(UserStatus::class, 'statuses_id');
    }
}

class Business extends Model
{
    use HasFactory;
    // view page all booking
    protected $table = 'businesses';
    protected $fillable = [
        'business_name',
        'logo',
        'address',
        'ward',
        'district',
        'city',
        'country',
        'fanpage_url',
        'website_url',
    ];

    public function users()
    {

        return $this->belongsTo(User::class, 'users_id');
    }
}
