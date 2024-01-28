<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $fillable = [
        'id',
        'customers_id',
        'services_id',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }
    public function services()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
}
