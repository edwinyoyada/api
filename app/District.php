<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function city()
    {
        return $this->belongsTo("App\City");
    }

    public function villages(){
        return $this->hasMany("App\Village");
    }


}
