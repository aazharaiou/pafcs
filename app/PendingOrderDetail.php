<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendingOrderDetail extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
