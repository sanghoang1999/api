<?php

namespace App\Model;
use App\Model\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable=[
        'name','detail','price','stock','discount'
    ];
    public function reviews() {
        return $this->hasMany(Review::class);
        
    }
}
