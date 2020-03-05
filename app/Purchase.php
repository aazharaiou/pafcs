<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    //

    public function purchasedetails()
    {
    	return $this->hasMany(PurchaseDetail::class);
    }

    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }

}
