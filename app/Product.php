<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Vendor;

class Product extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    //

    public function vendor()
    {
         return $this->belongsTo(Vendor::class);
    }

    public function purchasedetails()
    {
    	return $this->hasMany(PurchaseDetail::class);
    }

    public function saledetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public function salereturndetails()
    {
        return $this->hasMany(SaleReturnDetail::class);
    }

    public function invoicedetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_products')->withPivot('description');
        // return $this->hasOneThrough(CustomerProduct::class,Customer::class);
    }


}
