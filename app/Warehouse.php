<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Warehouse extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function purchasedetails()
    {
    	return $this->hasMany(PurchaseDetail::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function salereturndetails()
    {
        return $this->hasMany(SaleReturnDetail::class);
    }
}
