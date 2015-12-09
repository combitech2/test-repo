<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events';

	protected $fillable = ['place_facebook_id', 'name', 'description', 'starts_at'];

	public function venue() 
	{
		return $this->belongsTo('App\Models\Venue', 'place_facebook_id', 'facebook_id');
	}
}