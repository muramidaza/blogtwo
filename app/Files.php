<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;
use App\Files;

class Files extends Model
{

	public function posts()
	{
		return $this->belongsToMany(Posts::class);
	}

}
