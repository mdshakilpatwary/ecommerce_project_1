<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDealContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'offer_heading',
        'offer_content',
        'offer_duration_start',
        'offer_duration_end',
        'image1',
        'image2',
        
    ];
}
