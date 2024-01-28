<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Businesse extends Model
{
    use HasFactory;
    // view page all booking
    protected $table = 'businesses';
    protected $fillable = [
        'id',
        'business_name',
        'logo',
        'address',
        'ward',
        'district',
        'city',
        'fanpage_url',
        'website_url',
        'users_id',
    ];

    public function users()
    {

        return $this->belongsTo(User::class, 'users_id');
    }
}
