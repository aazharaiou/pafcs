<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
	use SoftDeletes;
    // protected $table = 'invoice_details';
    protected $guarded = [];
    //
    public function invoice()
    {
    	return $this->belongsTo(Invoice::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
