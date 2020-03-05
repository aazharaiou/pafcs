<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
	use SoftDeletes;
	protected $guarded = [];

	//

	public function territory()
	{
		return $this->belongsTo(Territory::class);
	}

	public function customerproducts()
	{
		return $this->hasMany(Customerproduct::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
	public function sales()
	{
		return $this->hasMany(Sale::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class,'customer_products')->withPivot('description');
	}
}