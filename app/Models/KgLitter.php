<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KgLitter extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'kg_litter',
        'status',
        
    ];


}
