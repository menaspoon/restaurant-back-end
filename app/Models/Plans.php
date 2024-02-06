<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model {
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = ["id", "plan"];



    public function counts() {
        return $this->hasOne('App\Models\Subscription', 'plan');
    }

    public function subscriptions() {
        return $this->hasMany('App\Models\Subscription', "plan");
    }

}
