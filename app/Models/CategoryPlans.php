<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPlans extends Model {
    use HasFactory;
    protected $table = 'category_plan';
    protected $fillable = ["id", "name"];
}
