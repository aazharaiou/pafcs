<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Territory extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    //

	public function customers()
	{
		return $this->hasMany(Customer::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
