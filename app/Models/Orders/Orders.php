<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model {
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [];
}
