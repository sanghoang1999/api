<?php

namespace App\Model;
use App\Model\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function reviews() {
        return $this->hasMany(Review::class);
        
    }
}
