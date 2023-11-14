<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'main_logo',
        'footer_logo',
        'email',
        'phone',
        'address',
        'description',
        
    ];
}
