<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
	protected $table = 'sale_details';
	protected $guarded = [];
    //

    public function sale()
    {
    	return $this->belongsTo(Sale::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
