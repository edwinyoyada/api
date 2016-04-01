<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {

	protected $fillable = [];

	protected $dates = [];

	public static $rules = [
		// Validation rules
	];

	public function cities()
	{
		return $this->hasMany("App\City");
	}


}
