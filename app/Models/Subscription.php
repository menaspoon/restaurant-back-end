<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plans;
use App\Models\Meals;


class Subscription extends Model {
    use HasFactory;
    protected $table = 'subscriptions';
    protected $fillable = ['id'];

    public function counts() : Returntype {
        return $this->belongsTo('App\Models\Plans', 'plan');
    }

    public function plans() {
        return $this->belongsTo(Plans::class, 'plan');
    }

    public function meals() {
        return $this->hasMany(Meals::class, 'id');
    }
}
