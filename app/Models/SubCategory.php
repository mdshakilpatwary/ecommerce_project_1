<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'subcat_id',
        'cat_id',
        'subcat_name',
        'subcat_image',
        'cat_status',
        
    ];

    function category(){
        return $this->belongsTo(Category::class, 'cat_id', 'id');
     }
}
