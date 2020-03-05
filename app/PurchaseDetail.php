<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Purchase;
use App\Product;
use App\Warehouse;

class PurchaseDetail extends Model
{
    use SoftDeletes;
    protected $table = 'purchase_details';
    protected $guarded = [];

    public function purchase()
    {
    	return $this->belongsTo(Purchase::class);
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
