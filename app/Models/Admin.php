<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'id',
        'admin_name',
        'logo',
        'users_id',
    ];

    public function users()
    {

        return $this->belongsTo(User::class, 'users_id');
    }
}
