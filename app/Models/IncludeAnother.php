<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncludeAnother extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'tax_vat',
        'shipping_charge_insite',
        'shipping_charge_outsite',
        'status',
        
    ];
}
