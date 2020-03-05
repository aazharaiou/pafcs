<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    //

    public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function invoicedetails()
    {
    	return $this->hasMany(InvoiceDetail::class);
    }

    // public function product()
    // {
    // 	return $this->belongsTo(Product::class);
    // }
}
