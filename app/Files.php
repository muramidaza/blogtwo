<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Posts;
use App\Files;

class Files extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	public function posts()
	{
		return $this->belongsToMany(Posts::class);
	}

}
