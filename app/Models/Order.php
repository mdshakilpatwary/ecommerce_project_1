<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
        use HasFactory;
        protected $fillable = [
            'id',
            'customer_id',
            'shipping_id',
            'payment_id',
            'total',
            'status',

            
        ];
    
        function customer(){
            return $this->belongsTo(User::class, 'customer_id', 'id');
         }
        function shipping(){
            return $this->belongsTo(ShippingDetails::class, 'shipping_id', 'id');
         }
        function payment(){
            return $this->belongsTo(PaymentMethod::class, 'payment_id', 'id');
         }



}
