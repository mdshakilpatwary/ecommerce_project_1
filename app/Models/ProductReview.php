<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductReview;
use App\Models\User;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'name',
        'email',
        'review',
        'rating',
        
    ];
    function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
     }
    function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
     }
}
