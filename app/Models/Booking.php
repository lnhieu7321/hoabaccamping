<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $fillable = [
        'type_of_day',
        'number_of_adults',
        'start_date',
        'end_date',
        'total_cost',
        'status_book',
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
