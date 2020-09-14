<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Model
{
	use SoftDeletes;
    protected $guarded = [];

	public function parent_company()
	{
		return $this->belongsTo(Buyer::class, 'parent', 'id');
	}

	public function child_companies()
	{
		return $this->hasMany(Buyer::class, 'parent', 'id');
	}

}


