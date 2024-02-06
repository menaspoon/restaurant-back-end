<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCases extends Model {
    use HasFactory;
    protected $table = 'delivery_cases';
    protected $fillable = [];
}
