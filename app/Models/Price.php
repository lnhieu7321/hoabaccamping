<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';
    protected $fillable = [
        'id',
        'type_of_day',
        'price_cost',
        'services_id',
    ];


    public function services()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
}
