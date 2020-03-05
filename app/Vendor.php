<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vendor extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function purchases()
    {
    	return $this->hasMany(Purchase::class);
    }

}

