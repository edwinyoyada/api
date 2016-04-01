<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

	protected $fillable = [];

	protected $dates = [];

	public static $rules = [
		// Validation rules
	];

	public function province()
	{
		return $this->belongsTo("App\Province");
	}
	public function districts()
	{
		return $this->hasMany("App\District");
	}


}
