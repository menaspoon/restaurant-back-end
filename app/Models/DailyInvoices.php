<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyInvoices extends Model {
    use HasFactory;
    protected $table = 'daily_invoices';
    protected $fillable = [];
}
