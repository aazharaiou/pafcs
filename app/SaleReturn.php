<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleReturnDetail;

class SaleReturn extends Model
{
	protected $guarded = [];
	
	// public function vendor()
 //    {
 //    	return $this->belongsTo(Vendor::class);
 //    }
    public function salereturndetails()
    {
    	return $this->hasMany(SaleReturnDetail::class,'salereturn_id');
    }

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
