<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
	protected $table = 'places';

	protected $fillable = ['facebook_id', 'name', 'checkins', 'description', 'lat', 'lng'];

	public function events() 
	{
		return $this->hasMany('App\Models\Event', 'place_facebook_id', 'facebook_id');
	}
}