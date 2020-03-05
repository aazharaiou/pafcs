<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Purchase;
use App\Product;
use App\Warehouse;

class OrderDetail extends Model
{
    use SoftDeletes;
    protected $table = 'order_details';
    protected $guarded = [];

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
 
    public function warehouse()
    {
    	return $this->belongsTo(Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
