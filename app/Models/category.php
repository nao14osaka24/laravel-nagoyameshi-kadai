<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public function favorite_products() {
        return $this->belongsToMany(Restaurant::class)->withTimestamps();
    }
}
