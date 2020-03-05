<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
	protected $guarded = [];
	
    //
    function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function orderdetails()
    {
    	return $this->hasMany(OrderDetail::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class,'order_id','id');
    }

    // public function saledetails()
    // {
    //     return $this->hasMany(SaleDetail::class);
    // }
}
