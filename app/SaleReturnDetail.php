<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleReturnDetail extends Model
{

    protected $guarded = [];

    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

public function salereturn()
{
	return $this->belongsTo(SaleReturn::class);
}

    public function warehouse()
    {
    	return $this->belongsTo(Warehouse::class);
    }
}
