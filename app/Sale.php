<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $guarded = [];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
    
    public function saledetails()
    {
    	return $this->hasMany(SaleDetail::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
}
