<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendingOrder extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function pendingorderdetails()
    {
    	return $this->hasMany(PendingOrderDetail::class);
    }
}
